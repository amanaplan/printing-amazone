import axios from 'axios';
import APP_URL from './boot.js';

$(document).ready(function(){
	$("span.remove-item").on('click', function(){

		startOverlay();

		let item = $(this).attr('data-cart-item');
		let elem = $(this);

		axios.delete(`${APP_URL}cart/remove-product`, {
		    params : { item: item },
		})
		.then(function (response) {
		    if(response.data == 0)
		    {
		    	$("div#cart").html(`
		    		<div class="feature">
						<div class="container">
							<div class="row" style="height: 400px">
								<h2>Your cart is empty</h2>
								<p class="subtitle">You may want to add some <a href="{{ url('/sticker') }}">product</a> in your cart.</p>
							</div>
						</div>
					</div>
		    	`);

		    	$("span#cartcount").remove();
		    }
		    else
		    {
		    	$("span#cartcount").html(response.data);
		    	elem.closest('tr').fadeOut();
		    }

		    closeOverlay();
		})
		.catch(function (error) {
			closeOverlay();
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
							<p class="subtitle">You may want to add some <a href="{{ url('/sticker') }}">product</a> in your cart.</p>
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
	//alert(qtyBox.closest('tr').find('span.current-price').html());
}

