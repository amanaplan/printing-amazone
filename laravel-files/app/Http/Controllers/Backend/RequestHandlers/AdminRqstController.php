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


}
