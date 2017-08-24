import axios from 'axios';
import APP_URL from './boot.js';

$(document).ready(function(){
	$("span.remove-item").on('click', function(){

		startOverlay();
		fillPricing(true, {});

		let item = $(this).attr('data-cart-item');
		let elem = $(this);

		axios.delete(`${APP_URL}cart/remove-product`, {
		    params : { item: item },
		})
		.then(function (response) {
		    if(response.data.count == 0)
		    {
		    	$("div#cart").html(`
		    		<div class="feature">
						<div class="container">
							<div class="row" style="height: 400px">
								<h2>Your cart is empty</h2>
								<p class="subtitle">You may want to add some <a href="${APP_URL}sticker">product</a> in your cart.</p>
							</div>
						</div>
					</div>
		    	`);

		    	$("span#cartcount").remove();
		    }
		    else
		    {
		    	$("span#cartcount").html(response.data.count);

		    	fillPricing(false, {total: response.data.total, discount: response.data.discount, payable: response.data.payable});

		    	elem.closest('tr').fadeOut();
		    }

		    closeOverlay();
		})
		.catch(function (error) {
			closeOverlay();
			fillPricing(false, {total: '__', discount: '__', payable: '__'});

			swal("Error!", error.message, "error");
		});
	});


	$(".clr-shopping").click(function(e){
		e.preventDefault();
		startOverlay()

		axios.delete(`${APP_URL}cart/empty-cart`, {
		})
		.then(function (response) {
			$("div#cart").html(`
	    		<div class="feature">
					<div class="container">
						<div class="row" style="height: 400px">
							<h2>Your cart is empty</h2>
							<p class="subtitle">You may want to add some <a href="${APP_URL}sticker">product</a> in your cart.</p>
						</div>
					</div>
				</div>
	    	`);

	    	$("span#cartcount").remove();

		    closeOverlay();
		})
		.catch(function (error) {
			closeOverlay();
			swal("Error!", error.message, "error");
		});
	});

	$("button.add-qty").click(function(){
		let qtyBox = $(this).closest('tr').find('input:text');
		let cartItemId = qtyBox.attr('data-cart-id');
		let currQty = parseInt($.trim(qtyBox.val()));

		let nextQty = 0;

		switch(currQty) {
		    case 10:
		        nextQty = 50;
		        break;
		    case 50:
		        nextQty = 100;
		        break;
		    case 100:
		        nextQty = 200;
		        break;
		    case 200:
		        nextQty = 300;
		        break;
		    case 300:
		        nextQty = 400;
		        break;
		    case 400:
		        nextQty = 500;
		        break;
		    case 500:
		        nextQty = 1000;
		        break;
		    case 20000:
		        nextQty = 20000;
		        break;
		    default:
		        nextQty = 1000;
		}

		if((currQty >= 1000) && (currQty < 20000) && (currQty % 1000 == 0))
		{
			nextQty = currQty + 1000;
		}

		qtyBox.val(nextQty);

		//change price
		updateProductPrice(cartItemId, qtyBox);
	});

	$("button.remove-qty").click(function(){
		let qtyBox = $(this).closest('tr').find('input:text');
		let cartItemId = qtyBox.attr('data-cart-id');
		let currQty = parseInt($.trim(qtyBox.val()));

		let nextQty = 0;

		switch(currQty) {
		    case 10:
		        nextQty = 10;
		        break;
		    case 50:
		        nextQty = 10;
		        break;
		    case 100:
		        nextQty = 50;
		        break;
		    case 200:
		        nextQty = 100;
		        break;
		    case 300:
		        nextQty = 200;
		        break;
		    case 400:
		        nextQty = 300;
		        break;
		    case 500:
		        nextQty = 400;
		        break;
		    case 1000:
		        nextQty = 500;
		        break;
		    default:
		        nextQty = 1000;
		}

		if((currQty > 1000) && (currQty <= 20000) && (currQty % 1000 == 0))
		{
			nextQty = currQty - 1000;
		}

		qtyBox.val(nextQty);

		//change price
		updateProductPrice(cartItemId, qtyBox);
	});

	$("input.cart-qty").change(function(){
		let cartItemId = $(this).attr('data-cart-id');
		let qtyBox = $(this);
		updateProductPrice(cartItemId, qtyBox);
	});

});

function startOverlay()
{
	$("div#loading-overlay").show();
}

function closeOverlay()
{
	$("div#loading-overlay").hide();
}

function updateProductPrice(cartId, qtyBox)
{
	//qty validation + tooltip error message 
	let allowedQty = [10,50,100,200,300,400,500];
	let currQty = parseInt(qtyBox.val());

	if(qtyBox.val().toString().indexOf('.') != -1)
	{
		showErrorMsg(qtyBox, 'must be of type integer');
		return false;
	}

	if(currQty < 1000)
	{
		if(allowedQty.indexOf(currQty) != -1)
		{
			showErrorMsg(qtyBox);
		}
		else
		{
			showErrorMsg(qtyBox, 'quantity not available');
			return false;
		}
	}
	else if(currQty >= 1000 && currQty <= 20000)
	{
		if(currQty % 1000 == 0)
		{
			showErrorMsg(qtyBox);
		}
		else
		{
			showErrorMsg(qtyBox, 'only multipe of 1k after 1k');
			return false;
		}
	}
	else if(currQty > 20000)
	{
		showErrorMsg(qtyBox, 'for more than 20k contact us');
		return false;
	}
	else
	{
		showErrorMsg(qtyBox, 'not a valid quantity');
		return false;
	}


	let priceFld = qtyBox.closest('tr').find('span.current-price');
	qtyBox.val(currQty);

	disableUpdateBtns(qtyBox, true);

	priceFld.html('<i class="fa fa-refresh fa-spin fa-lg"></i>');
	fillPricing(true, {});

	axios.post(`${APP_URL}cart/update-quantity`, {
	    cartid : cartId,
	    qty: currQty
	})
	.then(function (response) {
	    
	    if(response.data.error == 1)
	    {
	    	swal("Error!", response.data.msg, "error");
	    }

	    priceFld.html('<i class="fa fa-usd" aria-hidden="true"></i> '+response.data.price);
	    fillPricing(false, {total: response.data.total, discount: response.data.discount, payable: response.data.payable});

	    disableUpdateBtns(qtyBox, false);

	})
	.catch(function (error) {
		priceFld.html('<i class="fa fa-usd" aria-hidden="true"></i>__');
		fillPricing(false, {total: '__', discount: '__', payable: '__'});

		disableUpdateBtns(qtyBox, false);
		swal("Error!", "Oops some server error occurred", "error");
	});

}

function fillPricing(animate, prices)
{
	let payable = $("#tot-price");
	let discount = $("#cart-discount");
	let total = $("#cart-subtotal");

	if(animate)
	{
		let animation = '<i class="fa fa-refresh fa-spin fa-lg"></i>';
		total.html(animation);
		discount.html(animation);
		payable.html(animation);
	}
	else
	{
		total.html('<i class="fa fa-usd" aria-hidden="true"></i> '+prices.total);
		discount.html('<i class="fa fa-usd" aria-hidden="true"></i> '+prices.discount);
		payable.html('<i class="fa fa-usd" aria-hidden="true"></i> '+prices.payable);
	}
}

function showErrorMsg(qtyBox, msg = '')
{
	let errorTooltip = qtyBox.closest('tr').find('div.errtooltip');
	let errorMsgBox = qtyBox.closest('tr').find('div.errtooltip span.text');

	if(msg == '')
	{
		errorTooltip.hide();
		errorMsgBox.html('');
	}
	else
	{
		errorTooltip.show();
		errorMsgBox.html(msg+' <span class="instructions" title="we accept order quantity 10, 50, 100, multiple of 100 upto 500, 1000 then multiple of 1000 upto 20k"> <i class="fa fa-info-circle"></i></span>');
		
		$('.instructions').tooltipster({
			theme: 'tooltipster-punk',
			side: 'bottom',
			maxWidth: 400
		});
	}
}

function disableUpdateBtns(qtyBox, block = true)
{
	let rmvBtn = qtyBox.closest('tr').find('button.remove-qty');
	let addBtn = qtyBox.closest('tr').find('button.add-qty');
	if(block)
	{
		rmvBtn.prop('disabled', true);
		addBtn.prop('disabled', true);
	}
	else
	{
		rmvBtn.prop('disabled', false);
		addBtn.prop('disabled', false);
	}
	
}

