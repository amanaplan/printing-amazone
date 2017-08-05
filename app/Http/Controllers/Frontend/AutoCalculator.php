<?php

namespace App\Http\Controllers\Frontend;

use App\PresetGeneral;
use App\PresetQtyGrpOne;
use App\PresetQtyGrpTwo;

class AutoCalculator{

	public $mmsquare;
	public $qty;
	public $map_prod_form_option;
	public $price = 0.00;
	public $price1 = 0.00;
	public $price2 = 0.00;

	public function __construct($mmsquare, $qty, $map_prod_form_option)
	{
		$this->mmsquare = $mmsquare;
		$this->qty = $qty;
		$this->map_prod_form_option = $map_prod_form_option;
	}

	public function CalculatedPrice()
	{
		$genPreset = PresetGeneral::where([['map_prod_form_option', $this->map_prod_form_option], ['from', '<=', $this->mmsquare], ['to', '>=', $this->mmsquare]]);
		if($genPreset->count() == 0)
		{
			return false; //preset not defined for this range
		}
		else
		{
			//preset is defined now find the specific one
			$theGenPreset = $genPreset->firstOrFail();
			if($theGenPreset->is_base)
			{
				$this->price = ($theGenPreset->base_price/1000) * $this->qty;
			}
			else
			{
				//apply rule $Value per Cm2 x (W x D) x Profit % per sticker x Total Sticker Qty

				$this->price1 = $this->qty * $theGenPreset->val_per_mmsq * $this->mmsquare * ($theGenPreset->profit_percent / 100);

				/**check if previous group highest price is greater than current calculated**/

				//finding the previous preset range group
				$fromOfCurrGroup = $theGenPreset->from;
				$tmpImaginaryMMsq = $fromOfCurrGroup - 1;
				$previousPreset = PresetGeneral::where([['map_prod_form_option', $this->map_prod_form_option], ['from', '<=', $tmpImaginaryMMsq], ['to', '>=', $tmpImaginaryMMsq]])->first();
				if(! $previousPreset->is_base)
				{
					//we'll proceed only if it is not the base preset group

					$this->price2 = $this->qty * $previousPreset->val_per_mmsq * $tmpImaginaryMMsq * ($previousPreset->profit_percent / 100);
					$this->price = ($this->price2 > $this->price1)? $this->price2 : $this->price1;
				}
				else
				{
					$this->price = $this->price1;
				}
			}

			//apply qty rules
			$this->price = $this->applyQtyRuleOne();
			$this->price = $this->applyQtyRuleTwo();

			return round($this->price);
		}
	}

	public function applyQtyRuleOne()
	{
		$presetOne = PresetQtyGrpOne::where([['map_prod_form_option', $this->map_prod_form_option], ['order_qty_frm', '<=', $this->qty], ['order_qty_to', '>=', $this->qty]]);
		if($presetOne->count() > 0)
		{
			return $this->price * ($presetOne->first()->disc_rate/100);
		}
		else
		{
			return $this->price;
		}
	}

	public function applyQtyRuleTwo()
	{
		$presetTwo = PresetQtyGrpTwo::where([['map_prod_form_option', $this->map_prod_form_option], ['from', '<=', $this->qty], ['to', '>=', $this->qty]]);
		if($presetTwo->count() > 0)
		{
			$thePresetTwo = $presetTwo->first();

			$excess = $this->qty - $thePresetTwo->from;
			if($excess >= $thePresetTwo->every_extra_qty)
			{
				$j = floor($excess / $thePresetTwo->every_extra_qty);
				for($d = 0; $d < $j; $d++)
				{
					$this->price = $this->price - ($this->price * ($thePresetTwo->disc_rate/100));
				}


				return $this->price;
			}
			else
			{
				return $this->price;
			}
		}
		else
		{
			return $this->price;
		}
	}

	// function validateqty($qty)
	// {
	// 	if(empty($qty))
	// 	{
	// 		return false;
	// 	}
	// 	elseif ($qty < 100)
	// 	{
	// 		return false;
	// 	}
	// 	elseif (is_float($qty/10))
	// 	{
	// 		return false;
	// 	}
	// 	else
	// 	{
	// 		return true;
	// 	}
	// }
}