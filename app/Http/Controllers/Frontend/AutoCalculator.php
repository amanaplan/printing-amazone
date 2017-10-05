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

				$this->price1 /= 100; //for the mm problem

				/**check if previous group highest price is greater than current calculated**/

				//finding the previous preset range group
				$fromOfCurrGroup = $theGenPreset->from;
				$tmpImaginaryMMsq = $fromOfCurrGroup - 1;
				$previousPreset = PresetGeneral::where([['map_prod_form_option', $this->map_prod_form_option], ['from', '<=', $tmpImaginaryMMsq], ['to', '>=', $tmpImaginaryMMsq]])->first();
				if(! $previousPreset->is_base)
				{
					//this group is not base i.e. it has predefined val/mm2 profit% etc.
					$this->price2 = $this->qty * $previousPreset->val_per_mmsq * $tmpImaginaryMMsq * ($previousPreset->profit_percent / 100);
					
					$this->price2 /= 100; //for the mm problem
				}
				else
				{
					//this is the base group
					$this->price2 = ($previousPreset->base_price/1000) * $this->qty;
				}

				$this->price = ($this->price2 > $this->price1)? $this->price2 : $this->price1;
			}

			//apply qty rules
			$this->price = $this->applyQtyRuleOne();
			$this->price = $this->applyQtyRuleTwo();

			return round($this->price);
			return $this->price;
		}
	}

	public function applyQtyRuleOne()
	{
		$presetOne = PresetQtyGrpOne::where([['map_prod_form_option', $this->map_prod_form_option], ['order_qty', $this->qty]]);
		if($presetOne->count() > 0)
		{
			$this->price = $this->price / $this->qty;

			return $this->price * 1000 * ($presetOne->first()->disc_rate/100);
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
			$totalDisc = 0;

			$excess = $this->qty - $thePresetTwo->from;
			if($excess >= $thePresetTwo->every_extra_qty)
			{
				$j = floor($excess / $thePresetTwo->every_extra_qty);
				for($d = 0; $d < $j; $d++)
				{
					$totalDisc += $thePresetTwo->disc_rate;
				}
			}

			//now add discount rates of all the previous predefined preset of qty rule 2
			$finalTotalDisc = $this->recursivePercents($thePresetTwo, $totalDisc);

			return $this->price - ($this->price * ($finalTotalDisc/100));
		}
		else
		{
			return $this->price;
		}
	}

	/**
	*recusively adds % for the previous preset groups for qty rule group 2
	*/
	public function recursivePercents(PresetQtyGrpTwo $currGroup, $currTotalDisc)
	{
		$currFrom = $currGroup->from;
		$arbitraryQty = $currFrom - 1;  //an arbitrary qty that belongs to the previous preset group qty range
		$presetTwo = PresetQtyGrpTwo::where([['map_prod_form_option', $this->map_prod_form_option], ['from', '<=', $arbitraryQty], ['to', '>=', $arbitraryQty]]);

		if($presetTwo->count() > 0)
		{
			$thePresetTwo = $presetTwo->first();

			$excess = $thePresetTwo->to - $thePresetTwo->from;
			$j = floor($excess / $thePresetTwo->every_extra_qty);
			$totalDisc = 0;
			for($d = 0; $d < $j; $d++)
			{
				$totalDisc += $thePresetTwo->disc_rate;
			}

			$currTotalDisc += $totalDisc;

			//recursively checking previous avilability of presets
			$currTotalDisc = $this->recursivePercents($thePresetTwo, $currTotalDisc);

			return $currTotalDisc;
		}
		else
		{
			//there is no more qty rule group 2 previous preset
			return $currTotalDisc;
		}
	}

}
