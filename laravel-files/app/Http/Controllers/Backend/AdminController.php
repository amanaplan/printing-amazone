<?php

namespace App\Http\Controllers\Backend;

use Auth;

use App\Admin;
use App\Category;
use App\Product;

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
        $data = [
            'page'          => 'product_manage',
            'product'       => Product::findOrFail($id),
            'categories'    => Category::orderBy('created_at', 'desc')->get()
        ];
        return view('backend.product-edit', $data);
    }

}
