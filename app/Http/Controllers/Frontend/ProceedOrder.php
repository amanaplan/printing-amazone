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
use App\StickerType;
use App\PresetNamePhotoSticker;

use JavaScript;

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
            'type'          => 'nullable|integer|exists:sticker_types,id',
            'paperstock'    => 'required|integer',
            'circle_type'   => 'nullable|boolean',
            'size'          => 'required',
            'qty'           => 'required|integer',
            'size_w'		=> 'nullable|required_if:size,custom|numeric',
        ]);

        $validator->sometimes('size_h', 'required|numeric', function ($input) {
            return $input->size == 'custom' && $input->circle_type == 0;
        });

        if ($validator->fails()) {
        	$request->session()->flash('formError', 'Oops! something went wrong, please try again');
            return redirect()->back();
        }

        /*-----------------------------------------------------------------------------------------------
        | detect if it is name sticker / photo sticker & validate upon the provided form data
        -----------------------------------------------------------------------------------------------*/

        $product_slug = $request->input('product');

        if($product_slug == 'name-stickers' || $product_slug == 'photo-stickers')
        {
            $sticker_type = $request->input('type');
            $laminating = $request->input('laminating');

            if($sticker_type == null)
            {
                $request->session()->flash('formError', 'Please select a valid sticker type');
                return redirect()->back();
            }
            else if($laminating == null)
            {
                $request->session()->flash('formError', 'Please select a laminating option');
                return redirect()->back();
            }

            $name_sticker_data = [
                'sticker_type'  => StickerType::find($sticker_type)->name,
                'laminating'    => $laminating,
            ];
        }

        if($product_slug == 'name-stickers')
        {
            $sticker_name = $request->input('sticker_name');

            if ($sticker_name == null) {
                $request->session()->flash('formError', 'Please enter printing name');
                return redirect()->back();
            }

            $name_sticker_data['sticker_name'] = $sticker_name;
        }



        /*-----------------------------------------------------------------------------------------------
        | validating the input provided
        -----------------------------------------------------------------------------------------------*/
        $theProduct = Product::where('product_slug', $request->input('product'))->firstOrFail();
        $product = $theProduct->id;

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
            if ($product_slug == 'name-stickers' || $product_slug == 'photo-stickers')
            {
                $price_avlbl = PresetNamePhotoSticker::where([['product_id', $product], ['sticker_type', $request->input('type')], ['quantity_id', $request->input('qty')]])->exists();
                if(!$price_avlbl){
                    $request->session()->flash('formError', 'Oops! price not available for this sticker type');
                    return redirect()->back();
                }
            }
            else
            {
                if (PresetGeneral::where('map_prod_form_option', $map_paperstock_option->first()->id)->count() == 0) {
                    $request->session()->flash('formError', 'Oops! price not available for this paperstock');
                    return redirect()->back();
                }
            }
        }

        //---------------size option
        if($request->input('size') == 'custom')
        {
            if($theProduct->is_circle)
            {
                $width = $request->input('size_w');
                $height = $width;
            }
            else
            {
                $width = $request->input('size_w');
                $height = $request->input('size_h');
            }
            
            //check if its within the max min boundation
            $min = $theProduct->min_size;
            $max = $theProduct->max_size;

            if($width < $min || $width > $max || $height < $min || $height > $max)
            {
                $request->session()->flash('formError', 'Max. or Min. size (height x width) limit crossed');
                return redirect()->back();
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
        if($product_slug == 'name-stickers' || $product_slug == 'photo-stickers')
        {
            $price = PresetNamePhotoSticker::where([['product_id', $product], ['sticker_type', $request->input('type')], ['quantity_id', $qty_option_id]])->firstOrFail()->price;
        }
        else
        {
            $calculator = new AutoCalculator(($width * $height), $qty, $map_paperstock_option->first()->id);
            $price = $calculator->CalculatedPrice();
        }


        if($price == false)
        {
            $request->session()->flash('formError', 'Oops! price not available, try again later');
        	return redirect()->back();
        }

        $common_data = [
        	'product'		=> $product,
        	'paperstock'	=> $paperstock,
        	'width'			=> $width,
        	'height'		=> $height,
        	'qty'			=> $qty,
        	'price'			=> $price,
            'mapper'        => $map_paperstock_option->first()->id
        ];

        //if name sticker then add the additional parameters
        $storeInSession = ($product_slug == 'name-stickers' || $product_slug == 'photo-stickers')? array_merge($common_data, $name_sticker_data) : $common_data;

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

        $collection = Session::get('curr_product_payload');
        $product = Product::find($collection->get('product'));

        JavaScript::put([
            'any_artwork'   => $collection->has('artwork') ? true : false,
            'artworks'      => $collection->has('artwork') ? $collection->get('artwork') : false,
            '_submitURL'    => route('addto.cart'),
            'csrf'          => csrf_token(),
            'product_name' => $product->product_name,
            'product_img'   => $product->logo,
            'width'         => $collection->get('width'),
            'height'        => $collection->get('height'),
            'qty'           => $collection->get('qty'),
            'sticker_type'  => $collection->has('sticker_type') ? $collection->get('sticker_type') : false,
            'laminating'    => $collection->has('laminating') ? $collection->get('laminating') : false,
            'sticker_name'  => $collection->has('sticker_name') ? $collection->get('sticker_name') : false,
        ]);

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

        //upload attempt curr file
        $file = $request->file('file');
        $url = Storage::disk('public')->putFile('artworks', $file);
        
        if (! $file->isValid()) 
        {
            return response('not uploaded, 408');
        }

        //add artwork to payload collection
        //if any previous uploaded file exist
        if ($collection->has('artwork')) {
            $curr_artworks = $collection->get('artwork');
            array_push($curr_artworks, $url);

            $collection->put('artwork', $curr_artworks);
        }
        else{
            $collection->put('artwork', [$url]);
        }
        
        return response()->json(['file' => $url]);
    }

    /**
    *remove the current uploaded artwork
    */
    public function RemoveArtwork(Request $request)
    {
        $request->validate([
            'artwork_index' => 'required|integer'
        ]);

        //current payload collection
        $collection = $request->session()->get('curr_product_payload');

        if($collection->has('artwork'))
        {
            $artworks_arr = $collection->get('artwork');

            $the_artwork_to_remove = $artworks_arr[$request->input('artwork_index')];
            Storage::disk('public')->delete( $the_artwork_to_remove );

            unset( $artworks_arr[$request->input('artwork_index')] );
            $collection->put('artwork', array_values($artworks_arr));

            if(count($artworks_arr) == 0)
            {
                $collection->forget('artwork');
                return response()->json(['any_artwork' => false, 'artworks' => false]);
            }

            return response()->json(['any_artwork' => true, 'artworks' => array_values($artworks_arr)]);
        }

        return response('nothing to remove', 401);
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
        |  start check if cart token already exist otherwise create one
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
        |  end check if cart token already exist otherwise create one
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
            'sticker_type'  =>  $collection->get('sticker_type'),
            'laminating'    =>  $collection->get('laminating'),
            'sticker_name'  =>  $collection->get('sticker_name'),
            'instructions'  =>  $request->input('instructions'),
            'preset_mapper' =>  $collection->get('mapper'),
        ]);

        $cart->price = $collection->get('price');

        //for inserting artwork(s) to related model
        if ($collection->has('artwork')) {
            $artworks = $collection->get('artwork'); //contains array of artwork(s)
            $to_save = [];
            foreach ($artworks as $art) {
                $to_save[] = ['artwork' => $art];
            }

            $cart->artworks()->createMany($to_save);
        }

        $cart->save();

        //flush the curr product payload
        $request->session()->forget('curr_product_payload');

        return redirect()->route('cart');
    }
}
