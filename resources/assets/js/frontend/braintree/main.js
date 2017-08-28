import axios from 'axios';
import APP_URL from './../boot.js';

axios.post(`${APP_URL}checkout/get-client-token`, {
	generate: 1
}).then(function(response){

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
				console.log('Error', createErr);
				return;
			}
			form.addEventListener('submit', function (event) {
				event.preventDefault();

				instance.requestPaymentMethod(function (err, payload) {
					if (err) {
						console.log('Error', err);
						return;
					}

					// Add the nonce to the form and submit
					document.querySelector('#nonce').value = payload.nonce;
					form.submit();
				});
			});
		}
	);

}).catch(function(error){

	alert('need client token');

});
