<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\PresetGeneral;

use App\Http\Controllers\Frontend\AutoCalculator; //custom class calculates the pricing based on the preset

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Calculation extends Controller
{
    public function __construct()
    {

    }

    
    /**
    *generate price based on selected options in product page form
    */
    public function GenPrice(Request $request)
    {
        $this->validate($request, [
            'product'       => 'required|alpha_dash',
            'paperstock'    => 'required|integer',
            'size'          => 'required',
            'qty'           => 'nullable|integer',
            'customsize'    => 'nullable|boolean',
            'customqty'     => 'nullable|boolean',
        ]);

        //get the product
        $product = Product::where('product_slug', $request->input('product'))->firstOrFail()->id;

        /*----------------------------------------------------------------------
        |   Validating whether the options are linked to the product or not
        ------------------------------------------------------------------------*/

        //---------------paperstock option
        $paperstock = $request->input('paperstock');
        $map_field_paperstock_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 1]])->firstOrFail()->id;
        $map_paperstock_option = MapProdFrmOpt::where([['mapping_field_id', $map_field_paperstock_id],['option_id', $paperstock]]);
        if($map_paperstock_option->count() == 0)
        {
            abort(403, 'forbidden - paperstock not available');
        }
        else
        {
            //checking the paperstock has predefined presets or not
            if(PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->count() == 0)
            {
                abort(503, 'preset not defined');
            }
        }

        //---------------size option
        if($request->input('customsize') == 1)
        {
            $size_arr = $request->input('size');
            $width = $size_arr['width'];
            $height = $size_arr['height'];
            if(!is_numeric($width) || !is_numeric($height))
            {
                abort(422, 'width height not recognized');
            }

            //check if its within the max min boundation
            $generel_preset = PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->firstOrFail(); //just picking the first one as because all the max min limitations will be same for all rules
            $min = $generel_preset->min_size;
            $max = $generel_preset->max_size;

            if($width < $min || $width > $max)
            {
                return response()->json(['error' => 1, 'for' => 'w', 'msg' => 'width must be within '.$min.' to '.$max]);
            }
            else if($height < $min || $height > $max)
            {
                return response()->json(['error' => 1, 'for' => 'h', 'msg' => 'height must be within '.$min.' to '.$max]);
            }
        }
        else
        {
            //check if linked to the product
            $map_field_size_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 2]])->firstOrFail()->id;
            $map_size_option = MapProdFrmOpt::where([['mapping_field_id', $map_field_size_id],['option_id', $request->input('size')]])->count();
            if($map_size_option == 0)
            {
                abort(403, 'forbidden');
            }

            $size = OptSize::findOrFail($request->input('size'));
            $width = $size->width;
            $height = $size->height;
        }

        //--------------------quantity option
        if($request->input('customqty') == 1)
        {
            $validate = $this->validateqty($request->input('qty'));
            if($validate == false){
                return response()->json(['error' => 1, 'for' => 'q', 'msg' => 'qty. must be multiple of 10 & max 50k']);
            }

            $customQuantity = true;
        }
        else
        {
            $customQuantity = false;
        }

        //calculate the pricing
        $calculator = new AutoCalculator(($width * $height), 100, $map_paperstock_option->first()->id);
        $price = $calculator->CalculatedPrice();
        if($price == false)
        {
            abort(503, 'preset not defined');
        }
        else
        {
            //calculate price for the listed quantities
            $map_field_qty_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 3]])->firstOrFail()->id;
            $map_qty_option = MapProdFrmOpt::where('mapping_field_id', $map_field_qty_id)->select('option_id');
            if($map_qty_option->count() == 0)
            {
                abort(503, 'size options not selected by admin');
            }

            $orderedSizeOptns = $map_qty_option->orderBy('sort', 'asc')->get();
            $qtyValues = OptQty::find($orderedSizeOptns)->orderBy('option', 'asc')->get();
            $setOfPrices = [];
            foreach($qtyValues as $qtyOpt)
            {
                $calculator = new AutoCalculator(($width * $height), $qtyOpt->option, $map_paperstock_option->first()->id);
                $setOfPrices[] = $calculator->CalculatedPrice();
            }

            //if custom quantity entered then process it too
            if($customQuantity)
            {
                $calculator = new AutoCalculator(($width * $height), $request->input('qty'), $map_paperstock_option->first()->id);
                $customQtyPrice = $calculator->CalculatedPrice();
            }
            else
            {
                $customQtyPrice = 0.00;
            }

            return response()->json(['quantityPrice' => $customQtyPrice, 'setOfPrices' => $setOfPrices]);
        }
    }

    /**
    *quantity validation
    */
    function validateqty($qty)
    {
        if(empty($qty))
        {
            return false;
        }
        elseif ($qty < 10)
        {
            return false;
        }
        elseif (is_float($qty/10))
        {
            return false;
        }
        elseif($qty > 50000)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
