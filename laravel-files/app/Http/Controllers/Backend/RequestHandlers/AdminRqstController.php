<?php

namespace App\Http\Controllers\Backend\RequestHandlers;

use App\Category;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;

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
            //store applicable form fields
            if(count($request->input('fields')) > 0)
            {
                foreach($request->input('fields') as $field)
                {
                    $product->formfields()->attach($field);
                }

            }

            adminflash('success', 'new product added');
            return redirect('/admin/product/manage');
        }
        else
        {
            adminflash('warning', 'input data error');
            return redirect()->back();
        }
    }

    /**
    *update product
    */
    public function EditProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id'   => 'required|numeric',
            'product_name'  => ['required', 'min:5', Rule::unique('products','product_name')->ignore($id)],
            'description'   => 'required',
            'logo'          => ['required', 'regex:/\.(jpg|png|gif|jpeg)$/']
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $product                    = \App\Product::findOrFail($id);
        $product->category_id       = $request->input('category_id');
        $product->product_name      = $request->input('product_name');
        $product->product_slug      = str_slug($request->input('product_name'), '-');
        $product->logo              = $request->input('logo');
        $product->description       = $request->input('description');
        $product->sample_image      = $request->input('sample_img');

        $product->title             = $request->input('page_title');
        $product->meta_desc         = $request->input('meta_desc');
        $product->og_img            = $request->input('og_image');

        if($product->save())
        {
            /*update applicable form fields in mapping table*/

            //fetching existing data
            $existing_field = [];
            foreach($product->formfields as $field)
            {
                $existing_field[] = $field->pivot->form_field_id;
            }

            //current input data
            $inpitasfields = [];
            if(count($request->input('fields')) > 0)
            {
                foreach($request->input('fields') as $inpfield)
                {
                    $inpitasfields[] = $inpfield;
                }
            }

            /*new items to be inserted*/
            $toinsert = array_diff($inpitasfields,$existing_field);

            /*existing items to be removed*/
            $toremove = array_diff($existing_field,$inpitasfields);

            //processing insert
            if(count($toinsert) > 0)
            {
                foreach($toinsert as $row)
                {
                    $product->formfields()->attach($row);
                }
            }

            //processing remove
            if(count($toremove) > 0)
            {
                foreach($toremove as $row)
                {
                    $product->formfields()->detach($row);
                }
            }

            adminflash('success', 'product updated');
            return redirect('/admin/product/manage');
        }
        else
        {
            adminflash('warning', 'input data error');
            return redirect()->back();
        }
    }

    /**
    *sort product order
    */
    public function SortOrder(Request $request)
    {
        if(empty($request->input('id')) || empty($request->input('sort')))
        {
            abort(401);
        }

        $prod       = \App\Product::findOrFail($request->input('id'));
        $prod->sort = $request->input('sort');

        if($prod->save())
        {
            return response('updated', 200);
        }
        else
        {
            return response('error occurred', 401);
        }
    }

    /**
    *set navigation menu category order
    */
    public function SortNavOrder(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'sort' => 'required|numeric',
        ]);

        $category       = Category::findOrFail($request->input('id'));
        $category->sort = $request->input('sort');

        if($category->save())
        {
            return response('updated', 200);
        }
        else
        {
            return response('error occurred', 422);
        }
    }

    /**
    *new option add for paperstock
    */
    public function PaperstockInsert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option'   => 'required|min:3|unique:paperstock_options,option',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $papopt = new OptPaperstock();
        $papopt->option = $request->input('option');
        if($papopt->save())
        {
            adminflash('success', 'new option added');
            return redirect()->back();
        }

    }

    /**
    *new option add for size
    */
    public function SizeInsert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option'   => 'required|min:3|unique:size_options,display_value',
            'width'    => 'required|numeric',
            'height'   => 'required|numeric',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sizeopt = new OptSize();
        $sizeopt->display_value = $request->input('option');
        $sizeopt->width = $request->input('width');
        $sizeopt->height = $request->input('height');

        if($sizeopt->save())
        {
            adminflash('success', 'new option added');
            return redirect()->back();
        }

    }

    /**
    *new option add for quantity
    */
    public function QtyInsert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option'   => 'required|numeric|unique:qty_options,option',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $qtyopt = new OptQty();
        $qtyopt->option = $request->input('option');
        if($qtyopt->save())
        {
            adminflash('success', 'new option added');
            return redirect()->back();
        }

    }

    /**
    *update paperstock options
    */
    public function PaperstockUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'option'   => ['required', 'min:3', Rule::unique('paperstock_options','option')->ignore($id)],
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $papopt = OptPaperstock::findOrFail($id);
        $papopt->option = $request->input('option');
        if($papopt->save())
        {
            adminflash('success', 'option data updated');
            return redirect('/admin/form/paperstock');
        }
    }

    /**
    *new option add for size
    */
    public function SizeUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'option'   => ['required', 'min:3', Rule::unique('size_options','display_value')->ignore($id)],
            'width'    => 'required|numeric',
            'height'   => 'required|numeric',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $sizeopt = OptSize::findOrFail($id);
        $sizeopt->display_value = $request->input('option');
        $sizeopt->width = $request->input('width');
        $sizeopt->height = $request->input('height');

        if($sizeopt->save())
        {
            adminflash('success', 'option data updated');
            return redirect('/admin/form/size');
        }

    }

}
