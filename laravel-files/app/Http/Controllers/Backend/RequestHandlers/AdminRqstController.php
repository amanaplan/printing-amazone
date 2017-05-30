<?php

namespace App\Http\Controllers\Backend\RequestHandlers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;


class AdminRqstController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
    *add new category
    */
    public function AddCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name'	=> 'required|min:5|unique:category,category_name',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category                  	= new \App\Category();
        $category->category_name   	= $request->input('category_name');
        $category->category_slug   	= str_slug($request->input('category_name'), '-');
        $category->title 			= $request->input('page_title');
        $category->og_title    		= $request->input('page_title');
        $category->meta_desc     	= $request->input('meta_desc');
        $category->og_desc     		= $request->input('meta_desc');
        $category->og_img     		= $request->input('og_image');

        if($category->save())
        {
        	adminflash('success', 'new category created');
        	return redirect('/admin/category/manage');
        }
        else
        {
        	adminflash('warning', 'input data error');
        	return redirect()->back();
        }
    }

    /**
    *edit a category
    */
    public function EditCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ['required', 'min:5', Rule::unique('category','category_name')->ignore($id)]
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $category                   = \App\Category::findOrFail($id);
        $category->category_name    = $request->input('category_name');
        $category->category_slug    = str_slug($request->input('category_name'), '-');
        $category->title            = $request->input('page_title');
        $category->og_title         = $request->input('page_title');
        $category->meta_desc        = $request->input('meta_desc');
        $category->og_desc          = $request->input('meta_desc');
        $category->og_img           = $request->input('og_image');

        if($category->save())
        {
            adminflash('success', 'category updated');
            return redirect('/admin/category/manage');
        }
        else
        {
            adminflash('warning', 'input data error');
            return redirect()->back();
        }
    }

    /**
    *add new product
    */
    public function AddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'   => 'required|numeric',
            'product_name'  => 'required|min:5|unique:products,product_name',
            'description'   => 'required',
            'logo'          => ['required', 'regex:/\.(jpg|png|gif|jpeg)$/']
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product                    = new \App\Product();
        $product->category_id       = $request->input('category_id');
        $product->product_name      = $request->input('product_name');
        $product->product_slug      = str_slug($request->input('product_name'), '-');
        $product->logo              = $request->input('logo');
        $product->description       = $request->input('description');
        $product->sample_image      = $request->input('sample_img');

        //calculating the sort order of this product
        $curr_max_sort = \App\Product::where('category_id', $request->input('category_id'))->max('sort');
        $sort          = (empty($curr_max_sort))? 1 : $curr_max_sort + 1;

        $product->sort              = $sort;

        $product->title             = $request->input('page_title');
        $product->meta_desc         = $request->input('meta_desc');
        $product->og_img            = $request->input('og_image');

        if($product->save())
        {
            adminflash('success', 'new product added');
            return redirect('/admin/product/manage');
        }
        else
        {
            adminflash('warning', 'input data error');
            return redirect()->back();
        }
    }


}
