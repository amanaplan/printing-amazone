<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use App\Category;
use App\Product;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\Review;
use App\OptLamination;
use App\StickerType;
use App\Page;
use App\TemplateProdVar;

use App\Http\HelperClass\Multipurpose;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use JavaScript;

use Illuminate\Contracts\Encryption\DecryptException;

class PagesCtrl extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //features products
        $products = Redis::exists('prod_links') ? collect(json_decode(Redis::get('prod_links'))) : null;

        $data = [
            'text1'     => Redis::command('HGET', ['banner', 'text1']),
            'text2'     => Redis::command('HGET', ['banner', 'text2']),
            'btn1'      => Redis::command('HGET', ['banner', 'btn1']),
            'url1'      => Redis::command('HGET', ['banner', 'url1']),
            'btn2'      => Redis::command('HGET', ['banner', 'btn2']),
            'url2'      => Redis::command('HGET', ['banner', 'url2']),
            'prods'     => $products,
        ];

        return view('frontend.home', $data);
    }

    /**
    *the category page
    */
    public function category($slug)
    {
        $the_category = Category::with('products')->where('category_slug', $slug)->count();
        if($the_category == 0)
        {
            return $this->CmsPage($slug);
        }

    	$category = Category::with(['products' => function($query){
            $query->orderBy('sort', 'asc');
        }])->where('category_slug', $slug)->firstOrFail();

        //if redis has the data
        if(Redis::command('exists',['category:id:'.$category->id.':rate']))
        {
            $cacheData = Redis::get('category:id:'.$category->id.':rate');
            $cacheData = json_decode($cacheData);
            $averageRate    = $cacheData->rating;
            $totgiven       = $cacheData->total;
        }
        //otherwise evaluate and cach again
        else
        {
            $cache = new Multipurpose();
            $freshData = $cache->setCategoryCache($category->id);
            $freshData = json_decode($freshData);

            $averageRate    = $freshData->rating;
            $totgiven       = $freshData->total;
        }

        $data = [
            'category'  => $category,
            'avgrate'   => $averageRate,
            'totgiven'  => $totgiven
        ];

        return view('frontend.category', $data);
    }

    /**
    *the product page
    */
    public function product($categorySlug, $prodSlug)
    {
        $category = Category::where('category_slug', $categorySlug)->firstOrFail();
        $category_id = $category->id;

        $product = Product::where('product_slug', $prodSlug)->firstOrFail();
        if($product->category_id != $category_id)
        {
            abort(404);
        }

        //fetching the applicable form fields
        $fields = MapFrmProd::where('product_id', $product->id);
        $has_fields = ($fields->count() > 0)? true : false;
        $fieldstruct = [];

        if($has_fields)
        {
            $options = '';

            foreach ($fields->get() as $row) 
            {
                $options = MapProdFrmOpt::where('mapping_field_id', $row->id)->orderBy('sort', 'asc')->get();
                $opt_arr = [];

                switch ($row->form_field_id) 
                {
                    case 1:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('paperstock_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->option;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                        break;

                    case 2:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('size_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->display_value;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                        break;
                    default:
                        foreach($options as $option)
                        {
                            $opt_instance = DB::table('qty_options')->where('id', $option->option_id)->first();
                            $opt_arr[$opt_instance->id] = $opt_instance->option;
                        }

                        $fieldstruct[$row->form_field_id] = $opt_arr;
                }

            }
        }

        //user have pending review
        $pendingReview = null;

        if(Auth::guard('web')->check())
        {
            $unpublishedReview = $product->review()->where([['user_id', Auth::user()->id],['publish', 0]]);
            $pendingReview = ($unpublishedReview->count() > 0)? $unpublishedReview->first() : null;
        }
        //user have pending review

        //loadmore review button & the reviews to display
        if(Redis::command('exists',['product:id:'.$product->id.':reviews']))
        {
            $publishedReviewsToShow = json_decode(Redis::get('product:id:'.$product->id.':reviews'));
        }
        else
        {
            $cacheReview = new Multipurpose();
            $publishedReviewsToShow = $cacheReview->setProductCache($product->id, true);
        }

        $showmore = ($product->review()->published()->count() > 2)? true : false;
        //loadmore review button & the reviews to display

        //if redis has the data
        if(Redis::command('exists',['product:id:'.$product->id.':rate']))
        {
            $cacheData = Redis::get('product:id:'.$product->id.':rate');
            $cacheData = json_decode($cacheData);
            $averageRate    = $cacheData->rating;
            $totgiven       = $cacheData->total;
        }
        //otherwise evaluate and cach again
        else
        {
            $cache = new Multipurpose();
            $freshData = $cache->setProductCache($product->id);
            $freshData = json_decode($freshData);

            $averageRate    = $freshData->rating;
            $totgiven       = $freshData->total;
        }

        $data = [
            'product'       => $product,
            'has_fields'    => $has_fields,
            'fields'        => $fieldstruct,
            'pubreviews'    => $publishedReviewsToShow,
            'unpubreview'   => $pendingReview,
            'avgrate'       => $averageRate,
            'totgiven'      => $totgiven,
            'loadmore'      => $showmore
        ];

        //if it is name sticker
        if($prodSlug == 'name-stickers'){
            $data['laminations'] = $product->laminations()->orderBy('sort', 'asc')->get();
            $data['sticker_types'] = $product->stickertypes()->orderBy('sort', 'asc')->get();
            
            return view('frontend.product-name-stickers', $data);
        }
        //if it is photo sticker
        else if ($prodSlug == 'photo-stickers') {
            $data['laminations'] = $product->laminations()->orderBy('sort', 'asc')->get();
            $data['sticker_types'] = $product->stickertypes()->orderBy('sort', 'asc')->get();

            return view('frontend.product-name-stickers', $data);
        }
        else{
            //otherwise general product view page
            return view('frontend.product', $data);
        }
    }

    /**
    *access CMS page by slug
    */
    public function CmsPage($slug)
    {
        $page = Page::where('page_slug', $slug)->firstOrFail();

        return view('frontend.cms-page', ['page' => $page]);
    }

    /**
    *order confirmation page
    */
    public function OrderConfirm(Request $request)
    {
        if(Session::has('order_id') && Session::has('transaction_id'))
        {
            return view('frontend.order-confirm');
        }
        
        abort(404);
    }

    /**
    *tmplate download page
    */
    public function ShowTemplates()
    {
        $categories = Product::has('variations')->with(['category' => function($query){
            $query->select(['id','category_name','category_slug'])->orderBy('sort', 'asc');
        }])->select(['products.category_id'])->distinct()->get();

        foreach($categories as $item)
        {
            if($item->category->category_slug != 'uncategorized')
            {
                $currSelected = $item->category->id;
                break;
            }
        }

        JavaScript::put([
            'categories'    =>  $categories,
            'currpill'      =>  $currSelected,
            'initialproducts'   =>  Category::find($currSelected)->products()->has('variations')->select(['id', 'product_name', 'logo'])->get()
        ]);

        return view('frontend.template');
    }

    /**
    *get template products by category
    */
    public function GetTemplateProducts(Request $request)
    {
        $request->validate([
            'category_id'   =>  'required|integer|exists:category,id'
        ]);

        return Category::find($request->category_id)->products()->has('variations')->select(['id', 'product_name', 'logo'])->get();
    }

    /**
    *fetch templates by product id
    */
    public function GetTemplateByProduct(Request $request)
    {
        $request->validate([
            'product_id'    =>  'required|integer|exists:products,id'
        ]);

        return response()->json([
            'templates' =>  TemplateProdVar::where('product_id', $request->product_id)->orderBy('sort', 'asc')->select(['id', 'variation', 'template_file'])->get(),
            'productname' => Product::find($request->product_id)->product_name
        ]);
    }

    /**
    *review mockup view page for non customers
    */
    public function ReviewMockup($enc_order_id, $enc_order_item_id, $encrypted = true)
    {
        if($encrypted)
        {
            try {
                $order_token = decrypt($enc_order_id);
                $order_item_id = decrypt($enc_order_item_id);

            } catch (DecryptException $e) {
                abort(404, 'invalid tokens');
            }
        }
        else
        {
            $order_token = $enc_order_id;
            $order_item_id = $enc_order_item_id;
        }


        $order = \App\Order::ByToken($order_token)->firstOrFail();
        $order_item = \App\OrderItem::findOrFail($order_item_id);
        abort_if($order_item->order_id != $order->id, 401);

        //don't show the page if order completed/ order cancelled/ mockup approved
        if($order->orderStatus->status_text == "Completed" || $order->orderStatus->status_text == "Cancelled" || $order_item->mockup_approved == true)
        {
            abort(404);
            return false;
        }

        //checking whether mockup is ready
        if($order_item->artworks()->count() > 0) //if ever admin uploaded any mockup
        {
            if($order_item->artworks()->latest()->first()->review_text) //user requested change and the corresponding mockup not yet ready
            {
                $mockup_ready = false;
            }
            else
            {
                $mockup_ready = true;
            }
        }
        else //no single data in order_artwork_approval table
        {
            $mockup_ready = false;
        }

        //data for react
        JavaScript::put([
            '_hitURI'   => route('order.artwork.adjustment.request'),
            '_hitURIapprove'    => route('order.artwork.approve.request'),
            '_orderID_' => $order->order_token,
            '_orderedPROD'  => $order_item_id
        ]);

        $data = [
            'order_token'   =>  $order->order_token,
            'order_date'    =>  $order->created_at,
            'product'       =>  [
                                    'name'  =>  $order_item->product->product_name,
                                    'url'   =>  url('/'.$order_item->product->category->category_slug.'/'.$order_item->product->product_slug),
                                    'logo'  =>  $order_item->product->logo
                                ],
            'paperstock'    =>  $order_item->paperstock,
            'dimension'     =>  $order_item->width.' x '.$order_item->height,
            'user_artworks'  =>  $order_item->orderartworks,
            'user_desc'     =>  $order_item->instructions,
            'mockup_ready'  =>  $mockup_ready,
            'mockups'       =>  $order_item->artworks()->oldest()->get(),
            'latest_mockups' =>  optional($order_item->artworks()->latest()->first())->mockups
            
        ];

        return view('frontend.order-review-mockup', $data);
    }

}
