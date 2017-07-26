<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use App\OptPaperstock;
use App\OptQty;
use App\OptSize;
use App\MapFrmProd;
use App\FieldTypes;
use App\MapProdFrmOpt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PricingRules extends Controller
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
    *checks whether the product is eligible to have preset value
    *
    *@param product_id
    *@return bool
    */
    public function is_applicable($id)
    {
        $product = Product::findOrFail($id);
        if($product->formfields()->count() > 0)
        {
            if($product->formfields()->where('form_field_id', 1)->count() == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Show the preset options page for the product
     */
    public function RuleOptions($id)
    {
        if(! $this->is_applicable($id))
        {
            abort(404);
        }

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
        ];

        return view('backend.preset-rules', $data);
    }

    /**
    *pricing rules for general preset values
    */
    public function GeneralSetup($id)
    {
        if(! $this->is_applicable($id))
        {
            abort(404);
        }

        $mapid = MapFrmProd::where([['form_field_id', 1], ['product_id', $id]])->first()->id;
        $curr_options = MapProdFrmOpt::where('mapping_field_id', $mapid)->select('option_id')->get()->toArray();
        $paperstock_options = OptPaperstock::find($curr_options);

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
            'options'       => $paperstock_options
        ];

        return view('backend.preset-general-price', $data);
    }

}
