<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

use App\Http\Controllers\Frontend\AutoCalculator;
use Illuminate\Support\Facades\Storage;

use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\PresetGeneral;
use App\Cart;

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
        	'price'			=> $price,
            'mapper'        => $map_paperstock_option->first()->id
        ];

        $request->session()->put('curr_product_payload', collect($storeInSession));

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

    /**
    *upload artwork file
    */
    public function UploadFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:51200',
        ]);

        //current payload collection
        $collection = $request->session()->get('curr_product_payload');

        //remove if any previous uploaded file exist
        if($collection->has('artwork'))
        {
            Storage::disk('public')->delete($collection->get('artwork'));
            $collection->forget('artwork');
        }


        //upload attempt curr file
        $file = $request->file('file');
        $url = Storage::disk('public')->putFile('artworks', $file);
        
        if (! $file->isValid()) 
        {
            return response('not uploaded, 408');
        }

        //add artwork to payload collection
        $collection->put('artwork', $url);

        return response('uploaded, 200');
    }

    /**
    *remove the current uploaded artwork
    */
    public function RemoveArtwork(Request $request)
    {
        //current payload collection
        $collection = $request->session()->get('curr_product_payload');

        if($collection->has('artwork'))
        {
            Storage::disk('public')->delete($collection->get('artwork'));
            $collection->forget('artwork');
        }
    }

    /**
    *add product to cart
    */
    public function AddToCart(Request $request)
    {
        $this->validate($request, [
            'instructions' => 'nullable|string',
        ]);


        /*---------------------------------------------------------------------------------------------
        |   check if cart token already exist otherwise create one
        -----------------------------------------------------------------------------------------------*/
        
        if($request->session()->has('cart_token'))
        {
            $cart_token = $request->session()->get('cart_token');
        }
        else
        {
            $cart_token = bin2hex(openssl_random_pseudo_bytes(20));
            $request->session()->put('cart_token', $cart_token);
        }
        

        /*---------------------------------------------------------------------------------------------
        |   check if cart token already exist otherwise create one
        -----------------------------------------------------------------------------------------------*/

        //current payload collection
        $collection = $request->session()->get('curr_product_payload');

        $cart = Cart::create([
            'cart_token'    =>  $cart_token,
            'user_id'       =>  (Auth::guard('web')->check())? Auth::user()->id : 0,
            'product_id'    =>  $collection->get('product'),
            'paperstock'    =>  $collection->get('paperstock'),
            'width'         =>  $collection->get('width'),
            'height'        =>  $collection->get('height'),
            'qty'           =>  $collection->get('qty'),
            'label_option'  =>  $collection->get('label_option'),
            'sticker_name'  =>  $collection->get('sticker_name'),
            'artwork'       =>  $collection->get('artwork'),
            'instructions'  =>  $request->input('instructions'),
            'preset_mapper' =>  $collection->get('mapper'),
        ]);

        $cart->price = $collection->get('price');
        $cart->save();

        //flush the curr product payload
        $request->session()->forget('curr_product_payload');

        return redirect()->route('cart');
    }
}
