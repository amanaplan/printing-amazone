import createSnackbar from './snackbar/main';

import APP_URL from './../boot.js';


$(document).ready(function(){

	/** when page load complete then fetch prices asynchronously **/
	gatherInput();

	/** fetch price upon user interaction **/

	$("select[name='type']").change(function(){
		gatherInput();
	});

});

function erasePriceOverview(type='all')
{
	if(type == 'all'){
		$("span[id^=priceof]").each(function(){
			$(this).html('$ __');
		});
		$("span#qty-price").html('');
	}
	else if(type == 'size'){
		$("span[id^=priceof]").each(function(){
			$(this).html('$ __');
		});
	}
}

/** main price calculation ajax **/
function checkPrice(product, type)
{
	$("span[id^=priceof]").html('<i class="fa fa-cog fa-spin fa-lg text-success"></i>');

	$.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: APP_URL+"product/calculate-name-photo-price",
        type: "POST",
        dataType: 'json',
        data: { product: product, type: type },
        success: function(result){

        	if(result['error'] == 1){
                createSnackbar('Some server error occurred! please refresh and try again.', 'Dismiss');
        	}
        	else{

        		let count = 0;
        		$("span[id^=priceof]").each(function(){
        			$(this).html('$ '+result['setOfPrices'][count]);
        			count++;
        		});
        	}
        },
        error: function(xhr,status,error){
        	createSnackbar('Some server error occurred! please refresh and try again.', 'Dismiss');

        	erasePriceOverview('all');
        }
    });

    $.ajax();

}

function gatherInput(){
	let product = $("input#prodName").val();
	let type = $("select[name='type']").val();
    
    checkPrice(product, type);
}
