<?php

namespace App\Http\Controllers\Backend;

use Auth;

use App\Admin;
use App\Category;
use App\Product;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        return view('backend.dashboard', ['page' => 'dashboard']);
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
            'categories' =>  Category::with('products')->orderBy('created_at', 'desc')->get()

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
            'page'      => 'product_manage',
            'products'  => Product::orderBy('created_at', 'desc')->get()
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
            'options'   => OptQty::all()
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

}
