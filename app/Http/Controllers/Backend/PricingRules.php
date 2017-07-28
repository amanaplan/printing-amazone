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
use App\PresetGeneral;

use Validator;

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
    *list of added presets of general preset group
    */
    public function GeneralList($id)
    {
        if(! $this->is_applicable($id))
        {
            abort(404);
        }

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
            'presets'       => PresetGeneral::all()
        ];

        return view('backend.preset-general-price-list', $data);
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

    /**
    *add general preset rules
    */
    public function RqGeneralSetup(Request $request, $id)
    {
        if(! $this->is_applicable($id))
        {
            adminflash('error', 'action prevented');
            return redirect()->back();
        }

        /** validation **/
         $validator = Validator::make($request->all(), [
            'paperstock_option' => 'required|integer',
            'from'              => 'required|integer',
            'to'                => 'required|integer',
            'val_per_mm'        => 'nullable|required_unless:from,0|numeric',
            'profit'            => 'nullable|required_unless:from,0|numeric',
            'min_dimenssion'    => 'required|integer',
            'max_dimenssion'    => 'required|integer',
            'is_base'           => 'required|boolean',
            'fixed_price'       => 'nullable|required_unless:is_base,0|numeric',
        ],
        [
            'val_per_mm.required_unless'    => "unless it's the base preset you must provide value/mm2",
            'profit.required_unless'        => "unless it's the base preset you must provide profit %",
            'fixed_price.required_unless'   => "it is the base preset so you must provide base price",
        ]
        );

        if ($validator->fails()) {
            adminflash('warning', 'input error, please enter data correctly');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        /** finding the mappig option id **/
        $inp_paperstock_option = $request->input('paperstock_option');
        $field_mapping_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;

        $map_prod_form_option = MapProdFrmOpt::where([['mapping_field_id', $field_mapping_id],['option_id', $inp_paperstock_option]])->firstOrFail()->id;


        /** whether there is already a preset available for the specific paperstock option **/
        if(PresetGeneral::where('map_prod_form_option', $map_prod_form_option)->count() > 0)
        {
            adminflash('error', 'a preset for '.OptPaperstock::find($inp_paperstock_option)->option.' already exist');
            return redirect('/admin/product/presets/general/list/'.$id);
        }

        /** adding new preset **/
        PresetGeneral::create([
            'map_prod_form_option'  => $map_prod_form_option,
            'from'                  => $request->input('from'),
            'to'                    => $request->input('to'),
            'val_per_mmsq'          => $request->input('val_per_mm'),
            'profit_percent'        => $request->input('profit'),
            'min_size'              => $request->input('min_dimenssion'),
            'max_size'              => $request->input('max_dimenssion'),
            'is_base'               => $request->input('is_base'),
            'base_price'            => $request->input('fixed_price'),
        ]);

        adminflash('success', 'new preset successfully added');
        return redirect('/admin/product/presets/general/list/'.$id);
    }

    /**
    *remove general preset data
    */
    public function RmvGeneralPreset(Request $request)
    {
        $this->validate($request, [
            'id'    => 'required|integer',
            'type'  => 'required|alpha_dash',
        ]);

        switch ($request->input('type')) {
            case "general":
                PresetGeneral::destroy($request->input('id'));
                break;
            case "qty_one":
                //remove from quantity rule 1 model
                break;
            case "qty_two":
                //remove from quantity rule 2 model
                break;
            default:
                abort(422);
        }

    }

}
