import createSnackbar from './calculation/snackbar/main';
import axios from 'axios';

import APP_URL from './boot.js';

$("select[name='type']").change(function(){
	/*animation started*/
	startAnimation();

	var stickerType = $(this).val();
	axios.get(`${APP_URL}product/name-sticker/get-preview?artwork=${stickerType}`)
	.then(function (response) {
	    $("img#sticker-preview").attr("src", `${APP_URL}assets/images/products/${response.data}`);

	    stopAnimation();
	})
	.catch(function (error) {

		stopAnimation();

		createSnackbar('Invalid Sticker Type! try after some time', 'Dismiss');
	});
});

function startAnimation()
{
	$("#sticker-preview").css('opacity', 0.3);
	$(".middle").css('opacity', 1);
}

function stopAnimation()
{
	$("#sticker-preview").css('opacity', 1);
	$(".middle").css('opacity', 0);
}
