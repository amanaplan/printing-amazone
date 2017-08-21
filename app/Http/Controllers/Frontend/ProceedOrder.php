<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

use App\Http\Controllers\Frontend\AutoCalculator;

use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\PresetGeneral;

use Illuminate\Support\Facades\Session;

class ProceedOrder extends Controller
{
	public function __construct()
	{

	}

	/**
	*proceed from the continue button in product page selection form
	*
	*/
	public function Index(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'product'       => 'required|alpha_dash',
            'paperstock'    => 'required|integer',
            'size'          => 'required',
            'qty'           => 'nullable|integer',
            'size_w'		=> 'nullable|required_if:size,custom|numeric',
            'size_h'		=> 'nullable|required_if:size,custom|numeric',
        ]);

        if ($validator->fails()) {
        	$request->session()->flash('formError', 'Oops! something went wrong, please try again');

            return redirect()->back();
        }

        /*-----------------------------------------------------------------------------------------------
        | validating the input provided
        -----------------------------------------------------------------------------------------------*/
        $product = Product::where('product_slug', $request->input('product'))->firstOrFail()->id;

        //Validating whether the options are linked to the product or not

        //---------------paperstock option
        $paperstock = $request->input('paperstock');
        $map_field_paperstock_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 1]])->firstOrFail()->id;
        $map_paperstock_option = MapProdFrmOpt::where([['mapping_field_id', $map_field_paperstock_id],['option_id', $paperstock]]);
        if($map_paperstock_option->count() == 0)
        {
        	$request->session()->flash('formError', 'Oops! paperstock not available, please try again');
        	return redirect()->back();
        }
        else
        {
            //checking the paperstock has predefined presets or not
            if(PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->count() == 0)
            {
            	$request->session()->flash('formError', 'Oops! price not available for this paperstock');
        		return redirect()->back();
            }
        }

        //---------------size option
        if($request->input('size') == 'custom')
        {
            $width = $request->input('size_w');
            $height = $request->input('size_h');

            //check if its within the max min boundation
            $generel_preset = PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->firstOrFail(); //just picking the first one as because all the max min limitations will be same for all rules
            $min = $generel_preset->min_size;
            $max = $generel_preset->max_size;

            if($width < $min || $width > $max || $height < $min || $height > $max)
            {
                $request->session()->flash('formError', 'Max. size (height x width) limit crossed');
            }
        }
        else
        {
            //check if linked to the product
            $map_field_size_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 2]])->firstOrFail()->id;
            $map_size_option = MapProdFrmOpt::where([['mapping_field_id', $map_field_size_id],['option_id', $request->input('size')]])->count();
            if($map_size_option == 0)
            {
                $request->session()->flash('formError', 'Oops! input size not available for this product');
        		return redirect()->back();
            }

            $size = OptSize::findOrFail($request->input('size'));
            $width = $size->width;
            $height = $size->height;
        }

        //find out the quantity option value
        $qty_option_id = $request->input('qty');

        $map_field_qty_id = MapFrmProd::where([['product_id', $product], ['form_field_id', 3]])->firstOrFail()->id;
        $map_qty_option = MapProdFrmOpt::where([['mapping_field_id', $map_field_qty_id], ['option_id', $qty_option_id]]);
        if($map_qty_option->count() == 0)
        {
        	$request->session()->flash('formError', 'Oops! input quantity not available for this product');
        	return redirect()->back();
        }


        $qty = OptQty::findOrFail($qty_option_id)->option;
        

        /*-----------------------------------------------------------------------------------------------
        | end validating the input provided
        -----------------------------------------------------------------------------------------------*/


        /*-----------------------------------------------------------------------------------------------
        | calculate the pricing & set data to the session
        -----------------------------------------------------------------------------------------------*/

        $calculator = new AutoCalculator(($width * $height), $qty, $map_paperstock_option->first()->id);
        $price = $calculator->CalculatedPrice();
        if($price == false)
        {
            $request->session()->flash('formError', 'Oops! price not available, try again later');
        	return redirect()->back();
        }

        $storeInSession = [
        	'product'		=> $product,
        	'paperstock'	=> $paperstock,
        	'width'			=> $width,
        	'height'		=> $height,
        	'qty'			=> $qty,
        	'price'			=> $price
        ];

        $request->session()->put('curr_product_payload', json_encode($storeInSession));

        /*-----------------------------------------------------------------------------------------------
        | calculate the pricing & set data to the session
        -----------------------------------------------------------------------------------------------*/

		return redirect()->route('upload.artwork');
	}

	/**
	*upload artwork page
	*/
	public function UploadArtwork()
	{
		if(! Session::has('curr_product_payload'))
		{
			return redirect('/');
		}

		return view('frontend.upload-artwork');
	}
}
