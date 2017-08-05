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
            'customsize'    => 'required|boolean',
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
            abort(401);
        }
        else
        {
            //checking the paperstock has predefined presets or not
            if(PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->count() == 0)
            {
                abort(401, 'preset not defined');
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
                abort(401);
            }

            $size = OptSize::findOrFail($request->input('size'));
            $width = $size->width;
            $height = $size->height;
        }

        //calculate the pricing
        $calculator = new AutoCalculator(($width * $height), 100, $map_paperstock_option->first()->id);
        $price = $calculator->CalculatedPrice();
        if($price == false)
        {
            abort(404, 'preset not defined');
            //return response()->json(['error' => 0, 'msg' => 'preset not defined']);
        }
        else
        {
            return response()->json(['error' => 0, 'price' => $price]);
        }
    }
}
