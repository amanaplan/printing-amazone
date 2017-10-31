<?php

namespace App\Http\Controllers\Backend;

use Auth;

use App\Admin;
use App\Category;
use App\Product;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\MapFrmProd;
use App\FieldTypes;
use App\MapProdFrmOpt;
use App\Review;
use App\OptLamination;
use App\StickerType;
use App\User;
use App\Order;
use App\Page;
use App\TemplateProdVar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $data = [
            'page'  => 'dashboard',
            'product'   => Product::all()->count(),
            'customers' => User::all()->count(),
            'pending_order' => Order::ofType('pending')->count(),
            'total_reviews' => Review::published()->count(),
        ];

        return view('backend.dashboard', $data);
    }

    /**
    *admin profile page
    */
    public function profile()
    {
        return view('backend.profile', ['page' => '']);
    }

    /**
    *manage elfinder
    */
    public function MediaManager()
    {
        return view('backend.elfinder', ['page' => '']);
    }

    /**
    *manage elfinder for ckeditor
    */
    public function CkeditorMediaManager()
    {
        return view('backend.elfinder-ckeditor', ['page' => '']);
    }

    /**
    *manage added general admins
    */
    public function ListUsers()
    {
        $data = ['page' => 'manage_admins', 'admins' => Admin::where('id', '!=', Auth::user()->id)->orderBy('created_at', 'desc')->get()];
        return view('backend.list-admins', $data);
    }

    /**
    *add new admin account
    */
    public function AddUser()
    {
        return view('backend.addnewadmin', ['page' => 'new_admin']);
    }

    /**
    *add new category
    */
    public function AddCategory()
    {
        return view('backend.category-add', ['page' => 'category_add']);
    }

    /**
    *manage categories
    */
    public function ManageCategory()
    {
        $data = [
            'page'       => 'category_manage',
            'categories' =>  Category::with('products')->orderBy('sort', 'asc')->get()

        ];
        return view('backend.category-list', $data);
    }

    /**
    *edit category
    */
    public function EditCategory($id)
    {
        $data = [
            'page'      => 'category_manage',
            'category'  => Category::findOrFail($id)
        ];
        return view('backend.category-edit', $data);
    }

    /**
    *sort product appearance order
    */
    public function ReorderProducts($id)
    {
        $prods  = Product::where('category_id', $id);
        if($prods->count() == 0)
        {
            abort(404);
        }

        $data = [
            'page'      => 'product_manage',
            'products'  => $prods->orderBy('sort', 'asc')->get()
        ];
        return view('backend.product-sort', $data);
    }

    /**
    *add new product type i.e square sticker, rounded stickers etc.
    */
    public function AddProduct()
    {
        return view('backend.product-add', ['page' => 'product_add', 'categories' => Category::orderBy('created_at', 'desc')->get()]);
    }

    /**
    *manage Products
    */
    public function ManageProduct()
    {
        $data = [
            'page'          => 'product_manage',
            'products'      => Product::orderBy('created_at', 'desc')->with('category', 'review')->get(),
        ];
        return view('backend.product-list', $data);
    }

    /**
    *edit Products
    */
    public function EditProduct($id)
    {
        //the array list of applicable form field types
        $product = Product::findOrFail($id);
        $applicable_fields_arr = [];
        foreach($product->formfields as $field)
        {
            $applicable_fields_arr[] = $field->pivot->form_field_id;
        }
        

        $data = [
            'page'              => 'product_manage',
            'product'           => $product,
            'applicable_flds'   => $applicable_fields_arr,
            'categories'        => Category::orderBy('created_at', 'desc')->get()
        ];
        return view('backend.product-edit', $data);
    }

    /**
    *paperstock field options
    */
    public function FormPaperstock()
    {
        $data = [
            'page'      =>  'paperstock',
            'options'   => OptPaperstock::all()
        ];
        
        return view('backend.options-paperstock', $data);
    }

    /**
    *size field options
    */
    public function FormSize()
    {
        $data = [
            'page'      => 'size',
            'options'   => OptSize::all()
        ];
        
        return view('backend.options-size', $data);
    }

    /**
    *quantity field options
    */
    public function FormQuantity()
    {
        $data = [
            'page'      => 'qty',
            'options'   => OptQty::orderBy('option', 'asc')->get()
        ];
        
        return view('backend.options-qty', $data);
    }

    /**
    *edit page of paperstock option
    */
    public function EditFormPaperstock($id)
    {
        $data = [
            'page'      => 'paperstock',
            'option'   => OptPaperstock::findOrFail($id)
        ];
        
        return view('backend.options-paperstock-edit', $data);
    }

    /**
    *edit page of size option
    */
    public function EditFormSize($id)
    {
        $data = [
            'page'      => 'size',
            'option'   => OptSize::findOrFail($id)
        ];
        
        return view('backend.options-size-edit', $data);
    }

    /**
    *form options edit
    */
    public function EditFormFieldMapping($prodid, $fieldtype, $mapid)
    {
        $exist = MapFrmProd::where([['id', $mapid],['form_field_id', $fieldtype],['product_id', $prodid]])->count();
        if($exist == 0)
        {
            abort(404);
        }

        switch ($fieldtype) {
            case 1:
                $optios = OptPaperstock::all();
                $table = 'paperstock_options';
                break;
            case 2:
                $optios = OptSize::all();
                $table = 'size_options';
                break;
            case 3:
                $optios = OptQty::orderBy('option','asc')->get();
                $table = 'qty_options';
                break;
            default:
                abort(401);
        }


        $optarr = [];
        $curr_options = MapProdFrmOpt::where('mapping_field_id', $mapid)->select('option_id')->get();
        foreach($curr_options as $row)
        {
            $optarr[] = $row->option_id;
        }

        $data = [
            'page'      => 'product_manage',
            'product'   => Product::find($prodid)->product_name,
            'fieldname' => FieldTypes::find($fieldtype)->name,
            'options'   => $optios,
            'fieldtype' => $fieldtype,
            'mapid'     => $mapid,
            'curropt'   => $optarr,
            'selected'  => MapProdFrmOpt::where('mapping_field_id', $mapid)->orderBy('sort', 'asc')->get(),
            'table'     => $table
        ];

        return view('backend.map-field-options', $data);
    }

    /**
    *manage published and unpublished reviews
    */
    public function ManageReviews($state)
    {
        if($state == 'published')
        {
            $data = [
                'page'      => 'review-published',
                'reviews'   => Review::published()->latest()->with('user', 'product')->paginate(5)
            ];
            return view('backend.review-published-list', $data);
        }
        else if($state == 'unpublished')
        {
            $data = [
                'page'      => 'review-unpublished',
                'reviews'   => Review::unpublished()->latest()->with('user', 'product')->paginate(5)
            ];
            return view('backend.review-unpublished-list', $data);
        }
        else
        {
            abort(404);
        }
    }

    /**
    *edit page of review
    */
    public function EditReview($id)
    {
        $data = [
            'page'     => 'review-published',
            'review'   => Review::findOrFail($id)
        ];
        return view('backend.review-edit', $data);
    }

    /**
    *see lamination options page
    */
    public function VisitLaminationOptions()
    {
        $data = [
            'page'     => 'lamination',
            'options'  => OptLamination::orderBy('sort', 'asc')->get()
        ];
        return view('backend.options-lamination', $data);
    }

    /**
    *name sticker types list pages
    */
    public function VisitStickerTypes()
    {
        $data = [
            'page'     => 'sticker_type',
            'options'  => StickerType::orderBy('sort', 'asc')->get()
        ];
        return view('backend.options-sticker-type', $data);
    }

    /**
    *edit sticker type details
    */
    public function EditStickerType($id)
    {
        $data = [
            'page'     => 'sticker_type',
            'option'  => StickerType::findOrFail($id)
        ];
        return view('backend.options-edit-sticker-type', $data);
    }

    /**
    *manage customers
    */
    public function ManageCustomers(Request $request)
    {
        //search
        if($request->has('customer'))
        {
            $term = $request->input('customer');
            $customers = User::where('name', 'like', '%'.$term.'%')->orWhere('email', 'like', '%'.$term.'%')->orWhere('mobile', 'like', '%'.$term.'%')->withCount(['reviews' => function($query){
                return $query->where('publish', 1);
            }])->latest()->paginate(10);
        }
        else
        {
            $customers =  User::withCount(['reviews' => function($query){
                return $query->where('publish', 1);
            }])->latest()->paginate(10);
        }

        $data = [
            'page'  => 'customers',
            'customers' => $customers,
        ];

        return view('backend.customers', $data);
    }

    /**
    *add new cms page
    */
    public function CMSAddPage()
    {
        $data = [
            'page'  => 'page_add',
        ];

        return view('backend.cms-add-page', $data);
    }

    /**
    *CMS pages list
    */
    public function CMSPagesList()
    {
        $data = [
            'page'  => 'page_manage',
            'pages' => Page::orderBy('page_name', 'asc')->get()
        ];

        return view('backend.cms-list-pages', $data);
    }

    /**
    *edit page
    */
    public function EditPage($id)
    {
        $data = [
            'page'      => 'page_manage',
            'cmspage'   => Page::findOrFail($id)
        ];

        return view('backend.cms-edit-page', $data);
    }

    /**
    *manage home page contents
    */
    public function CMSManageHomeBanner()
    {
        $data = [
            'page'      => 'banner',
            'text1'     => Redis::command('HGET', ['banner', 'text1']),
            'text2'     => Redis::command('HGET', ['banner', 'text2']),
            'btn1'      => Redis::command('HGET', ['banner', 'btn1']),
            'url1'      => Redis::command('HGET', ['banner', 'url1']),
            'btn2'      => Redis::command('HGET', ['banner', 'btn2']),
            'url2'      => Redis::command('HGET', ['banner', 'url2']),
        ];

        return view('backend.cms-home-banner', $data);
    }

    /**
    *manage product links of home page
    */
    public function CMSManageProdLinks()
    {
        $data = [
            'page'          => 'product_links',
            'products'      => Product::select(['id', 'product_name'])->orderBy('product_name', 'asc')->get(),
            'curr_prods'    => Redis::exists('prod_links') ? json_decode(Redis::get('prod_links')) : null,
        ];

        return view('backend.cms-prod-links-page', $data);
    }

    /**
    *manage added templates
    */
    public function ManageTemplates()
    {
        $templates = Product::has('variations')
                            ->withCount('variations')
                            ->with(['variations' => function($query){
                                                $query->orderBy('sort', 'asc');
                                            }, 
                                    'category:id,category_slug'])
                            ->orderBy('product_name', 'asc')->get();

        $data = [
            'page'          => 'template',
            'products'      => $templates
        ];

        return view('backend.template-list', $data);
    }

    /**
    *manage added templates
    */
    public function AddTemplates()
    {
        $data = [
            'page'          => 'template_add',
            'categories'    => Category::orderBy('created_at', 'desc')->get()
        ];

        return view('backend.template-add', $data);
    }

    /**
    *edit template page
    */
    public function EditTemplate($id)
    {
        $data = [
            'page'          => 'template',
            'template'      => TemplateProdVar::findOrFail($id)
        ];

        return view('backend.template-edit', $data);
    }

    /**
    *category wise product fetch
    */
    public function GetProductsByCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|exists:category,id'
        ]);

        $products = Category::find($request->input('category'))->products()->select('products.id','product_name')->get();

        return $products;
    }

    /**
    *sort template appearance
    */
    public function SortTemplate($id)
    {
        $templates = TemplateProdVar::where('product_id', $id)->get();

        $data = [
            'page'          => 'template',
            'templates'      => $templates
        ];

        return view('backend.template-sort', $data);
    }

}
