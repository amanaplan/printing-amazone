import axios from 'axios';
import APP_URL from './../boot.js';

axios.post(`${APP_URL}checkout/get-client-token`, {
	generate: 1
}).then(function(response){
	//client token received

	let client_token = response.data.token;

	let dropin = require('braintree-web-drop-in');
	let form = document.querySelector('#checkout-form');

	dropin.create({
			authorization: client_token,
			selector: '#bt-dropin',
			paypal: {
				flow: 'vault'
			}
		}, 
		function (createErr, instance) {
			if (createErr) {
				//console.log('Error', createErr);
				swal("Error!", 'Oops! something went wrong try again', "error");
				return;
			}
			form.addEventListener('submit', function (event) {
				event.preventDefault();
				disableOrderPlaceBtn(true);

				//check if basic field validation is ok
				axios.post(`${APP_URL}checkout/place-order`, {
					name: $("input[name='name']").val(),
					email: $("input[name='email']").val(),
					phone: $("input[name='phone']").val(),
					country: $("select[name='country']").val(),
					state: $("input[name='state']").val(),
					city: $("input[name='city']").val(),
					zipcode: $("input[name='zipcode']").val(),
					street: $("textarea[name='street']").val(),
					company: $("input[name='company']").val(),

				}).then(function(response){

					if(response.data.error == 1)
					{
						swal("Error!", response.data.err_msg, "error");
						disableOrderPlaceBtn(false);
					}
					else
					{
						//general validation success now get nonce

						instance.requestPaymentMethod(function (err, payload) {
							if (err) {
								//console.log('Error', err);
								swal("Error!", "Invalid payment details, try again", "error");
								disableOrderPlaceBtn(false);
								return;
							}

							//client token + nonce all receiced process the price detuction

							axios.post(`${APP_URL}checkout/process-payment`,{
								payment_method_nonce: payload.nonce
							}).then(function(response){

								//return to order confirm page with order & transaction id
								document.location.assign(`${APP_URL}order-confirm`);

							}).catch(function(error){
								swal("Error!", 'Oops! payment processing unsuccessful, try again', "error");
								disableOrderPlaceBtn(false);
							});
						});
					}
				}).catch(function(error){
					//server level validation process page error
					swal("Error!", 'Oops! something went wrong try again', "error");
				});

			});
		}
	);

}).catch(function(error){
	//client token not found
	swal("Error!", 'Oops! something went wrong try again', "error");
});

function disableOrderPlaceBtn(disable = true)
{
	if(disable)
	{
		$("button#place-order").html('<i class="fa fa-spinner fa-pulse"></i> Processing. .');
		$("button#place-order").prop('disabled', true);
	}
	else
	{
		$("button#place-order").html('Place Order');
		$("button#place-order").prop('disabled', false);
	}
}
