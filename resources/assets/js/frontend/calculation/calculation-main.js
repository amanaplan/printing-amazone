import createSnackbar from './snackbar/main';

import APP_URL from './../boot.js';


$(document).ready(function(){

	/** when page load complete then fetch prices asynchronously **/
	gatherInput();

	/** shows the custom input data enter boxes **/
	$("input[name='size']").change(function(){
		if($(this).val() == 'custom')
		{
			$("div.custom-input").show();

			erasePriceOverview('all');
		}
		else{
			$("div.custom-input").hide();
			$("div.custom-input input:text").val('');
		}
	});

	/*$("input[name='qty']").change(function(){
		erasePriceOverview('qty');

		if($(this).val() == 'custom')
		{
			$("div.custom-qty-input").show();
		}
		else{
			$("div.custom-qty-input").hide();
			$("div.custom-qty-input input:text").val('');
		}
	});*/
	/** shows the custom input data enter boxes **/

	/** fetch price upon user interaction **/

	$(".paperstock-opt").change(function(){
		gatherInput();
	});

	$(".size-opt").change(function(){
		gatherInput();
	});

	$("button.check-price").click(function(){
		//validate then check
		$("span#size-err").html('').hide();
		//$("span#qty-err").html('').hide();

		gatherInput();
	});

	$("div.custom-input input:text").on('input', function(){
		$(this).css('border', '1px none');
		erasePriceOverview('all');
	});

	/*$("div.custom-qty-input input:text").on('input', function(){
		$(this).css('border', '1px none');
		erasePriceOverview('qty');
	});*/

	$("div.custom-input input:text").on('keydown', function(e){
		if(e.keyCode == 13){
	        $("span#size-err").html('').hide();
	        //$("span#qty-err").html('').hide();
	        gatherInput();
	    }
	});
	/*$("div.custom-qty-input input:text").on('keydown', function(e){
		if(e.keyCode == 13){
	        $("span#size-err").html('').hide();
	        $("span#qty-err").html('').hide();
	        gatherInput();
	    }
	});*/
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
	/*else if(type == 'qty'){
		$("span#qty-price").html('');
	}*/
}

class calForm {

	errorFor(field, msg){
		let widthBox = $("input[name='size_w']");
		let heightBox = $("input[name='size_h']");
		//let qtyBox = $("input[name='quantity']");

		if(field == 'h'){
			heightBox.focus();
			heightBox.css('border', '1px solid red');
        	widthBox.css('border', '1px none');
        	//qtyBox.css('border', '1px none');

        	erasePriceOverview('all');

    		$("span#size-err").html(msg).show();
		}
		else if(field == 'w'){
			widthBox.focus();
			widthBox.css('border', '1px solid red');
        	heightBox.css('border', '1px none');
        	//qtyBox.css('border', '1px none');

        	erasePriceOverview('all');

    		$("span#size-err").html(msg).show();
		}
		/*else
		{
			qtyBox.focus();
			qtyBox.css('border', '1px solid red');
			widthBox.css('border', '1px none');
        	heightBox.css('border', '1px none');

        	erasePriceOverview('all');

    		$("span#qty-err").html(msg).show();
		}*/

	}

	noError(){
		let widthBox = $("input[name='size_w']");
		let heightBox = $("input[name='size_h']");
		//let qtyBox = $("input[name='quantity']");

		heightBox.css('border', '1px none');
        widthBox.css('border', '1px none');
        //qtyBox.css('border', '1px none');
        $("span#size-err").html('').hide();
        //$("span#qty-err").html('').hide();

        //removing the snackbar
        $("div.paper-snackbar").remove();
	}
}

/** main price calculation ajax **/
function checkPrice(product,paperstock,size,quantityVal=0,customSize,customQty=0)
{
	$("span[id^=priceof]").html('<i class="fa fa-cog fa-spin fa-lg text-success"></i>');
	//$("span#qty-price").html('<i class="fa fa-spinner fa-pulse fa-lg text-success"></i>');

	$.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: APP_URL+"product/calculate-price",
        type: "POST",
        dataType: 'json',
        data: {product:product, paperstock:paperstock, customsize:customSize, size:size, qty:quantityVal, customqty:customQty},
        success: function(result){
        	let calform = new calForm();

        	if(result['error'] == 1){

        		if(result['for'] == 'h'){
        			calform.errorFor('h', result['msg']);
        		}
        		else if(result['for'] == 'w')
        		{
        			calform.errorFor('w', result['msg']);
        		}
        		/*else
        		{
        			calform.errorFor('q', result['msg']);
        		}*/
        	}
        	else{
        		calform.noError();

        		let count = 0;
        		$("span[id^=priceof]").each(function(){
        			$(this).html('$ '+result['setOfPrices'][count]);
        			count++;
        		});

        		/*if(result['quantityPrice'] != 0)
        		{
        			$("span#qty-price").html('$ '+result['quantityPrice']);
        		}*/
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
	let paperstock = $("select[name='paperstock']").val();
	let size = $("input[name='size']:checked").val();
	let circle_type = $("input#circle_type").val();
	//let quantity = $("input[name='qty']:checked").val();
	let customSize = 0;
	//let customQty = 0;
	if(size == 'custom')
	{
		let calform = new calForm();

		if(circle_type == 1)
		{
			var widthBox = $("input[name='size_w']");
			var width = $.trim(widthBox.val());
			var height = width;
		}
		else
		{
			var widthBox = $("input[name='size_w']");
			var heightBox = $("input[name='size_h']");
			var width = $.trim(widthBox.val());
			var height = $.trim(heightBox.val());
		}

		//validation
		if(isNaN(width) || width == ""){
			calform.errorFor('w', 'Oops! invalid input');
		}
		else if(isNaN(height) || height == ""){
			calform.errorFor('h', 'Oops! invalid input');
		}
		else
		{
			calform.noError();

			size = {"width":width, "height":height};
			customSize = 1;

			checkPrice(product,paperstock,size,0,customSize,0);
		}
	}
	/*else if(quantity == 'custom' && size != 'custom')
	{
		let calform = new calForm();

		let qtyBox = $("input[name='quantity']");
		let quantityVal = $.trim(qtyBox.val());

		//validation
		if(isNaN(quantityVal) || quantityVal == ""){
			calform.errorFor('q', 'Oops! invalid input');
		}
		else if(quantityVal.toString().indexOf('.') != -1)
		{
			calform.errorFor('q', 'qty. should be integer');
		}
		else if((parseInt(quantityVal)/10) % 1 !== 0){
			calform.errorFor('q', 'qty. must be multiple of 10');
		}
		else if(parseInt(quantityVal) > 50000){
			calform.errorFor('q', `for quantity more than 50k please <a href="${APP_URL}contact">contact us</a>`);
		}
		else
		{
			calform.noError();
			customQty = 1;

			checkPrice(product,paperstock,size,quantityVal,customSize,customQty);
		}
	}
	else if(quantity == 'custom' && size == 'custom')
	{
		let calform = new calForm();

		let widthBox = $("input[name='size_w']");
		let heightBox = $("input[name='size_h']");
		let qtyBox = $("input[name='quantity']");
		let quantityVal = $.trim(qtyBox.val());
		let width = $.trim(widthBox.val());
		let height = $.trim(heightBox.val());

		//validation
		if(isNaN(width) || width == ""){
			calform.errorFor('w', 'Oops! invalid input');
		}
		else if(isNaN(height) || height == ""){
			calform.errorFor('h', 'Oops! invalid input');
		}
		else if(isNaN(quantityVal) || quantityVal == ""){
			calform.errorFor('q', 'Oops! invalid input');
		}
		else if(quantityVal.toString().indexOf('.') != -1)
		{
			calform.errorFor('q', 'qty. should be integer');
		}
		else if((quantityVal/10) % 1 !== 0){
			calform.errorFor('q', 'qty. must be multiple of 10');
		}
		else if(parseInt(quantityVal) > 50000){
			calform.errorFor('q', `for quantity more than 50k please <a href="${APP_URL}contact">contact us</a>`);
		}
		else
		{
			calform.noError();

			size = {"width":width, "height":height};
			customSize = 1;
			customQty = 1;

			checkPrice(product,paperstock,size,quantityVal,customSize,customQty);
		}
	}*/
	else
	{
		checkPrice(product,paperstock,size,0,customSize,0);
	}
}
