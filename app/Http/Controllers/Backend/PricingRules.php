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
use App\PresetQtyGrpOne;
use App\PresetQtyGrpTwo;

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

        $map_field_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;
        $map_form_opt_id = MapProdFrmOpt::where('mapping_field_id', $map_field_id)->select('id')->get();

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
            'presets'       => PresetGeneral::whereIn('map_prod_form_option', $map_form_opt_id)->get()
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
            'to'                => 'required|integer|greater_than_field:from',
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
                PresetQtyGrpOne::destroy($request->input('id'));
                break;
            case "qty_two":
                PresetQtyGrpTwo::destroy($request->input('id'));
                break;
            default:
                abort(422);
        }

    }

    /**
    *edit page of general preset
    */
    public function EditPageGenPreset($preset_id, $prod_id)
    {
        $preset = PresetGeneral::findOrFail($preset_id);
        $paperstock_opt = MapProdFrmOpt::findOrFail($preset->map_prod_form_option)->option_id;

        $data = [  
            'page'          => 'product_manage',
            'option'        => OptPaperstock::findOrFail($paperstock_opt)->option,
            'preset'        => $preset,
            'preset_id'     => $preset_id,
            'product_id'    => $prod_id
        ];

        return view('backend.preset-general-price-edit', $data);
    }

    /**
    *edit general preset
    */
    public function EditGenPreset(Request $request, $preset_id, $prod_id)
    {
        /** validation **/
         $validator = Validator::make($request->all(), [
            'from'              => 'required|integer',
            'to'                => 'required|integer|greater_than_field:from',
            'val_per_mm'        => 'nullable|required_unless:from,0|numeric',
            'profit'            => 'nullable|required_unless:from,0|numeric',
            'min_dimenssion'    => 'required|integer',
            'max_dimenssion'    => 'required|integer',
            'is_base'           => 'required|boolean',
            'fixed_price'       => 'nullable|required_unless:is_base,0|numeric|between:1,10000',
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


        /** updating preset data **/
        $preset = PresetGeneral::findOrFail($preset_id);
        $preset->from               = $request->input('from');
        $preset->to                 = $request->input('to');
        $preset->val_per_mmsq       = $request->input('val_per_mm');
        $preset->profit_percent     = $request->input('profit');
        $preset->min_size           = $request->input('min_dimenssion');
        $preset->max_size           = $request->input('max_dimenssion');
        $preset->is_base            = $request->input('is_base');
        $preset->base_price         = ($request->input('is_base') == 0) ? 0.00 : $request->input('fixed_price');

        $preset->save();

        adminflash('success', 'preset data updated');
        return redirect('/admin/product/presets/general/list/'.$prod_id);
    }

    /**
    *pricing rules for quantity rule one
    */
    public function QtyRuleOneSetup($id)
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

        return view('backend.preset-qtyrule-one', $data);
    }

    /**
    *list of added presets of quantity rule 1 preset group
    */
    public function QtyRuleOneList($id)
    {
        if(! $this->is_applicable($id))
        {
            abort(404);
        }

        $map_field_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;
        $map_form_opt_id = MapProdFrmOpt::where('mapping_field_id', $map_field_id)->select('id')->get();

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
            'presets'       => PresetQtyGrpOne::whereIn('map_prod_form_option', $map_form_opt_id)->get()
        ];

        return view('backend.preset-qtyrule-one-list', $data);
    }

    /**
    *add quantity rule group 1 preset data
    */
    public function RqQtyRuleOneSetup(Request $request, $id)
    {
        if(! $this->is_applicable($id))
        {
            adminflash('error', 'action prevented');
            return redirect()->back();
        }

        /** validation **/
         $validator = Validator::make($request->all(), [
            'paperstock_option' => 'required|integer',
            'qty'               => 'required|integer',
            'discount'          => 'required|numeric',
        ]);

        if ($validator->fails()) {
            adminflash('warning', 'input error, please enter data correctly');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        /** finding the mappig option id **/
        $inp_paperstock_option = $request->input('paperstock_option');
        $field_mapping_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;

        $map_prod_form_option = MapProdFrmOpt::where([['mapping_field_id', $field_mapping_id],['option_id', $inp_paperstock_option]])->firstOrFail()->id;


        /** adding new preset **/
        PresetQtyGrpOne::create([
            'map_prod_form_option'  => $map_prod_form_option,
            'order_qty'             => $request->input('qty'),
            'disc_rate'             => $request->input('discount'),
        ]);

        adminflash('success', 'new preset successfully added');
        return redirect('/admin/product/presets/qty-rule-first/list/'.$id);
    }

    /**
    *edit page of quantity rule group 1 preset
    */
    public function EditPageQtyRuleOnePreset($preset_id, $prod_id)
    {
        $preset = PresetQtyGrpOne::findOrFail($preset_id);
        $paperstock_opt = MapProdFrmOpt::findOrFail($preset->map_prod_form_option)->option_id;

        $data = [  
            'page'          => 'product_manage',
            'option'        => OptPaperstock::findOrFail($paperstock_opt)->option,
            'preset'        => $preset,
            'preset_id'     => $preset_id,
            'product_id'    => $prod_id
        ];

        return view('backend.preset-qtyrule-one-edit', $data);
    }

    /**
    *edit quantity rule group 1 preset
    */
    public function EditQtyRuleOnePreset(Request $request, $preset_id, $prod_id)
    {
        /** validation **/
         $validator = Validator::make($request->all(), [
            'qty'               => 'required|integer',
            'discount'          => 'required|numeric',
        ]);

        if ($validator->fails()) {
            adminflash('warning', 'input error, please enter data correctly');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        /** updating preset data **/
        $preset = PresetQtyGrpOne::findOrFail($preset_id);
        $preset->order_qty           = $request->input('qty');
        $preset->disc_rate           = $request->input('discount');

        $preset->save();

        adminflash('success', 'preset data updated');
        return redirect('/admin/product/presets/qty-rule-first/list/'.$prod_id);
    }

    /**
    *pricing rules for quantity rule two
    */
    public function QtyRuleTwoSetup($id)
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

        return view('backend.preset-qtyrule-two', $data);
    }

    /**
    *list of added presets of quantity rule 2 preset group
    */
    public function QtyRuleTwoList($id)
    {
        if(! $this->is_applicable($id))
        {
            abort(404);
        }

        $map_field_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;
        $map_form_opt_id = MapProdFrmOpt::where('mapping_field_id', $map_field_id)->select('id')->get();

        $data = [  
            'page'          => 'product_manage',
            'product_id'    => $id,
            'product_name'  => Product::findOrFail($id)->product_name,
            'presets'       => PresetQtyGrpTwo::whereIn('map_prod_form_option', $map_form_opt_id)->get()
        ];

        return view('backend.preset-qtyrule-two-list', $data);
    }

    /**
    *add quantity rule group 2 preset data
    */
    public function RqQtyRuleTwoSetup(Request $request, $id)
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
            'to'                => 'nullable|integer|greater_than_field:from',
            'extra'             => 'required|integer',
            'discount'          => 'required|numeric',
        ]);

        if ($validator->fails()) {
            adminflash('warning', 'input error, please enter data correctly');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        /** finding the mappig option id **/
        $inp_paperstock_option = $request->input('paperstock_option');
        $field_mapping_id = MapFrmProd::where([['product_id', $id],['form_field_id', 1]])->firstOrFail()->id;

        $map_prod_form_option = MapProdFrmOpt::where([['mapping_field_id', $field_mapping_id],['option_id', $inp_paperstock_option]])->firstOrFail()->id;


        /** adding new preset **/
        PresetQtyGrpTwo::create([
            'map_prod_form_option'  => $map_prod_form_option,
            'every_extra_qty'       => $request->input('extra'),
            'from'                  => $request->input('from'),
            'to'                    => $request->input('to'),
            'disc_rate'             => $request->input('discount'),
        ]);

        adminflash('success', 'new preset successfully added');
        return redirect('/admin/product/presets/qty-rule-sec/list/'.$id);
    }

    /**
    *edit page of quantity rule group 2 preset
    */
    public function EditPageQtyRuleTwoPreset($preset_id, $prod_id)
    {
        $preset = PresetQtyGrpTwo::findOrFail($preset_id);
        $paperstock_opt = MapProdFrmOpt::findOrFail($preset->map_prod_form_option)->option_id;

        $data = [  
            'page'          => 'product_manage',
            'option'        => OptPaperstock::findOrFail($paperstock_opt)->option,
            'preset'        => $preset,
            'preset_id'     => $preset_id,
            'product_id'    => $prod_id
        ];

        return view('backend.preset-qtyrule-two-edit', $data);
    }


    /**
    *edit quantity rule group 2 preset
    */
    public function EditQtyRuleTwoPreset(Request $request, $preset_id, $prod_id)
    {
        /** validation **/
         $validator = Validator::make($request->all(), [
            'from'              => 'required|integer',
            'to'                => 'nullable|integer|greater_than_field:from',
            'extra'             => 'required|integer',
            'discount'          => 'required|numeric',
        ]);

        if ($validator->fails()) {
            adminflash('warning', 'input error, please enter data correctly');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        /** updating preset data **/
        $preset = PresetQtyGrpTwo::findOrFail($preset_id);
        $preset->from               = $request->input('from');
        $preset->to                 = $request->input('to');
        $preset->every_extra_qty    = $request->input('extra');
        $preset->disc_rate          = $request->input('discount');

        $preset->save();

        adminflash('success', 'preset data updated');
        return redirect('/admin/product/presets/qty-rule-sec/list/'.$prod_id);
    }

}
