const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/frontend/reviewPost.js', 'public/assets/frontend/js/review.js')
	.js('resources/assets/js/frontend/calculation/calculation-main.js', 'public/assets/frontend/js/calculation.js')
	.js('resources/assets/js/frontend/nameStickerPreview.js', 'public/assets/frontend/js/nameStickerPreview.js')
	.js('resources/assets/js/frontend/uploadArtwork.js', 'public/assets/frontend/js/uploadArtwork.js')
	.js('resources/assets/js/frontend/cart.js', 'public/assets/frontend/js/cart.js');
