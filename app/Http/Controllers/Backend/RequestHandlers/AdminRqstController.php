<?php

namespace App\Http\Controllers\Backend\RequestHandlers;

use App\Category;
use App\Product;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\MapFrmProd;
use App\MapProdFrmOpt;
use App\Review;
use App\PresetGeneral;
use App\PresetQtyGrpOne;
use App\PresetQtyGrpTwo;
use App\ProductSpecial;

use App\Http\HelperClass\Multipurpose;
use Illuminate\Support\Facades\Redis;

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
                    $mapid = MapFrmProd::where([['product_id', $product->id],['form_field_id', $row]])->first()->id;
                    MapProdFrmOpt::where('mapping_field_id', $mapid)->delete();
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
    *update special product
    */
    /**
    *update product
    */
    public function EditSpProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description'   => 'required',
            'logo'          => ['required', 'regex:/\.(jpg|png|gif|jpeg)$/']
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $product                    = \App\ProductSpecial::findOrFail($id);
        $product->logo              = $request->input('logo');
        $product->description       = $request->input('description');
        $product->sample_image      = $request->input('sample_img');

        $product->title             = $request->input('page_title');
        $product->meta_desc         = $request->input('meta_desc');
        $product->og_img            = $request->input('og_image');

        if($product->save())
        {
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

    /**
    *update options mapping for a product's specific form field type
    */
    public function OptMapUpdate(Request $request, $mapid)
    {
        //curr data of applicable options for the field & for the product

        $currindb = MapProdFrmOpt::where('mapping_field_id', $mapid);
        $currarr = $selected = [];
        if($currindb->count() > 0){
            foreach($currindb->get() as $curr)
            {
                $currarr[] = $curr->option_id;
            }
        }

        //selected checkboxes from the form

        $inpoptions = $request->input('options');
        if(count($inpoptions) > 0){
            foreach($inpoptions as $row)
            {
                $selected[] = $row;
            }
        }


        //to insert
        $tosave = array_diff($selected,$currarr);

        if(count($tosave) > 0)
        {
            foreach($tosave as $saveitem){
                MapProdFrmOpt::create(['mapping_field_id' => $mapid, 'option_id' => $saveitem]);
            }
        }

        //to remove
        $torem = array_diff($currarr,$selected);

        if(count($torem) > 0)
        {
            $isPaperstock = (MapFrmProd::find($mapid)->form_field_id == 1)? true : false;

            foreach($torem as $remitem){
                $theOptMaping = MapProdFrmOpt::where([['mapping_field_id', $mapid], ['option_id', $remitem]]);

                //if it is a paperstock option then remove the presets
                if($isPaperstock)
                {
                    $optMapId = $theOptMaping->first()->id;
                    PresetGeneral::where('map_prod_form_option', $optMapId)->delete();
                    PresetQtyGrpOne::where('map_prod_form_option', $optMapId)->delete();
                    PresetQtyGrpTwo::where('map_prod_form_option', $optMapId)->delete();    
                }            
                //or skip

                $theOptMaping->delete();
            }
        }


        adminflash('success', 'applicable options data updated');
        return redirect()->back();
        
    }

    /**
    *sort field options
    */
    public function SortFieldOption(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'sort' => 'required|numeric',
        ]);

        $mapping       = MapProdFrmOpt::findOrFail($request->input('id'));
        $mapping->sort = $request->input('sort');

        if($mapping->save())
        {
            return response('updated', 200);
        }
        else
        {
            return response('error occurred', 422);
        }
    }

    /**
    *publish or unpublish review
    */
    public function ToggleReviewState(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        $review = Review::findOrFail($request->input('id'));

        $review->publish = ($review->publish == 0)? 1 : 0;
        if($review->save())
        {
            //refreshing the cache data
            $product_id = $review->product_id;
            $category_id = Product::find($product_id)->category_id;
            $cache = new Multipurpose();
            $cache->setCategoryCache($category_id);
            $cache->setProductCache($product_id);

            return response('review state updated', 200);
        }
        else
        {
            abort(401);
        }
    }

    /**
    *delete review
    */
    public function DeleteReview(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        $review = Review::find($request->input('id'));

        $product_id = $review->product_id;
        $category_id = Product::find($product_id)->category_id;

        //delete review
        $review->delete();

        $cache = new Multipurpose();
        $cache->setCategoryCache($category_id);
        $cache->setProductCache($product_id);
    }

    /**
    *edit review request
    */
    public function EditReviewRq(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:8|max:60',
            'description'   => 'required|min:10',
            'rating'        => 'required|numeric',
        ]);


        if ($validator->fails()) {
            adminflash('warning', 'incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $review                 = Review::findOrFail($id);
        $review->title          = $request->input('title');
        $review->description    = $request->input('description');
        $review->rating         = $request->input('rating');

        if($review->save())
        {
            //refreshing the cache data
            $product_id = $review->product_id;
            $category_id = Product::find($product_id)->category_id;
            $cache = new Multipurpose();
            $cache->setCategoryCache($category_id);
            $cache->setProductCache($product_id);
            
            adminflash('success', 'review updated');
            return redirect()->back();
        }

    }

    /**
    *remove product
    */
    public function RemoveProduct(Request $request)
    {
        $productId = $request->input('product');
        $product = (array) $productId;

        $this->RemoveProductAndDependencs($product);
    }

    /**
    *remove category
    */
    public function RemoveCategory(Request $request)
    {
        $id = $request->input('category');
        $category = Category::findOrFail($id);

        $products = $category->products()->select('id')->get();
        $prodArr = [];

        //extracting to array
        foreach($products as $prod)
        {
            $prodArr[] = $prod->id;
        }

        //remove the products
        $this->RemoveProductAndDependencs($prodArr);

        //remove the category
        $category->delete();
    }

    /**
    *remove the products & associated data
    */
    public function RemoveProductAndDependencs(array $ids) :void
    {
        foreach($ids as $id)
        {
            $product = Product::findOrFail($id);

            //remove all the reviews
            $product->review()->delete();

            $formFields = MapFrmProd::where('product_id', $id);
            if($formFields->count() > 0)
            {
                $fieldMapIds = $formFields->get();

                foreach($fieldMapIds as $fieldId)
                {
                    $theOption = MapProdFrmOpt::where('mapping_field_id', $fieldId->id);
                    $fieldMapOptions = $theOption->select('id')->get();

                    //remove presets
                    PresetGeneral::whereIn('map_prod_form_option', $fieldMapOptions)->delete();
                    PresetQtyGrpOne::whereIn('map_prod_form_option', $fieldMapOptions)->delete();
                    PresetQtyGrpTwo::whereIn('map_prod_form_option', $fieldMapOptions)->delete();

                    //remove field options
                    $theOption->delete();
                }

                //remove field mappings
                $formFields->delete();
            }

            //remove the product
            $product->delete();
        }
    }

    /**
    *remove quantity option
    */
    public function QtyRemove(Request $request)
    {
        $this->validate($request, [
            'option_id' => 'required|integer',
        ]);

        $qtyMappings = MapFrmProd::where('form_field_id', 3)->select('id')->get();
        MapProdFrmOpt::whereIn('mapping_field_id', $qtyMappings)->where('option_id', $request->input('option_id'))->delete();

        OptQty::destroy($request->input('option_id'));
        
        adminflash('success', 'quantity option removed completely');
        return redirect()->back();
    }

    /**
    *remove size option
    */
    public function SizeRemove(Request $request)
    {
        $this->validate($request, [
            'option_id' => 'required|integer',
        ]);

        $sizeMappings = MapFrmProd::where('form_field_id', 2)->select('id')->get();
        MapProdFrmOpt::whereIn('mapping_field_id', $sizeMappings)->where('option_id', $request->input('option_id'))->delete();

        OptSize::destroy($request->input('option_id'));
        
        adminflash('success', 'size option removed completely');
        return redirect()->back();
    }

    /**
    *remove paperstock option
    */
    public function PaperstockRemove(Request $request)
    {
        $this->validate($request, [
            'option_id' => 'required|integer',
        ]);

        $papstockMappings = MapFrmProd::where('form_field_id', 1)->select('id')->get();
        $papOPtMaps = MapProdFrmOpt::whereIn('mapping_field_id', $papstockMappings)->where('option_id', $request->input('option_id'));

        $optionMapIds = $papOPtMaps->select('id')->get();

        //remove the option mappings
        $papOPtMaps->delete();

        OptPaperstock::destroy($request->input('option_id'));

        //remove the price presets
        PresetGeneral::whereIn('map_prod_form_option', $optionMapIds)->delete();
        PresetQtyGrpOne::whereIn('map_prod_form_option', $optionMapIds)->delete();
        PresetQtyGrpTwo::whereIn('map_prod_form_option', $optionMapIds)->delete();
        
        adminflash('success', 'paperstock option removed completely');
        return redirect()->back();
    }
    

}
