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
								<p class="subtitle">You may want to add some <a href="${APP_URL}">product</a> in your cart.</p>
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
							<p class="subtitle">You may want to add some <a href="${APP_URL}">product</a> in your cart.</p>
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

	$("select.cart-qty").change(function(){
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
	let quantity = null;
	if (isInt(qtyBox.val())){
		showErrorMsg(qtyBox, '')
		quantity = parseInt(qtyBox.val());
	}
	else{
		showErrorMsg(qtyBox, 'quantity not available');
		return false;
	}

	let priceFld = qtyBox.closest('tr').find('span.current-price');

	disableQtyDropdown(qtyBox, true);

	priceFld.html('<i class="fa fa-refresh fa-spin fa-lg"></i>');
	fillPricing(true, {});

	axios.post(`${APP_URL}cart/update-quantity`, {
	    cartid : cartId,
		qty: quantity
	})
	.then(function (response) {
	    
	    if(response.data.error == 1)
	    {
	    	swal("Error!", response.data.msg, "error");
	    }

	    priceFld.html('<i class="fa fa-usd" aria-hidden="true"></i> '+response.data.price);
	    fillPricing(false, {total: response.data.total, discount: response.data.discount, payable: response.data.payable});

	    disableQtyDropdown(qtyBox, false);

	})
	.catch(function (error) {
		priceFld.html('<i class="fa fa-usd" aria-hidden="true"></i>__');
		fillPricing(false, {total: '__', discount: '__', payable: '__'});

		disableQtyDropdown(qtyBox, false);
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
		errorMsgBox.html(msg);
	}
}

function disableQtyDropdown(qtyBox, block = true)
{
	if(block)
	{
		qtyBox.prop('disabled', true);
	}
	else
	{
		qtyBox.prop('disabled', false);
	}
	
}

/**
 * check whether cart qty is integer
 */
function isInt(value) {
	return !isNaN(value) &&
		parseInt(Number(value)) == value &&
		!isNaN(parseInt(value, 10));
}

