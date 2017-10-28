<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//[default laravel auth with remved register path]
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('/register', 'Auth\RegisterController@register');


/*-----------------------------------------------------------------------------------------------------
|front-end global accessible routes
|------------------------------------------------------------------------------------------------------
*/
Route::get('/', 'Frontend\PagesCtrl@index');
Route::view('/template', 'frontend.template');
Route::view('/contact', 'frontend.contact');
Route::post('/product/give-review', 'Frontend\UserReviewPost');
Route::post('/product/load-reviews', 'Frontend\AjaxCtrl@LoadReviews');
Route::post('/product/calculate-price', 'Frontend\Calculation@GenPrice');
Route::get('/labels', 'Frontend\DirectProduct');
Route::get('/graphic-designs', 'Frontend\DirectProduct');
Route::get('/product/name-sticker/get-preview', 'Frontend\AjaxCtrl@ShowPreview');
Route::post('/place-order/proceed', 'Frontend\ProceedOrder@Index');
Route::get('/upload-artwork', 'Frontend\ProceedOrder@UploadArtwork')->name('upload.artwork');
Route::post('/upload-artwork/process-upload', 'Frontend\ProceedOrder@UploadFile');
Route::post('/upload-artwork/remove-current', 'Frontend\ProceedOrder@RemoveArtwork');
Route::post('/cart/add-product', 'Frontend\ProceedOrder@AddToCart')->name('addto.cart');
Route::get('/cart', 'Frontend\CartCtrl@Visit')->name('cart');
Route::delete('/cart/remove-product', 'Frontend\CartCtrl@RemoveItem');
Route::delete('/cart/empty-cart', 'Frontend\CartCtrl@ClearCart');
Route::post('/cart/update-quantity', 'Frontend\CartCtrl@UpdateQty');
Route::get('/checkout', 'Frontend\Checkout@Visit');
Route::post('/checkout/get-client-token', 'Frontend\Checkout@GetBTClientToken');
Route::post('/checkout/place-order', 'Frontend\Checkout@PlaceOrder')->name('checkout.post');
Route::post('/checkout/process-payment', 'Frontend\Checkout@PaymentProcess');
Route::get('/order-confirm', 'Frontend\PagesCtrl@OrderConfirm')->name('order.confirm');
Route::post('/request/label-graphics', 'Frontend\CustomRequest@CustomProds')->name('product.request');
Route::post('/request/contact', 'Frontend\CustomRequest@Contact')->name('contact.request');


//users not allowed to access these routes if they are logged in
Route::group(['middleware' => ['shouldnotbeloggedin']], function () {

	Route::post('/attempt/google-login', 'Frontend\AjaxCtrl@googleLogin');
	Route::post('/attempt/google-signup', 'Frontend\AjaxCtrl@googleSignup');
	Route::post('/attempt/user-login', 'Frontend\AjaxCtrl@UserLogin');
	Route::post('/attempt/signup-via-email', 'Frontend\AjaxCtrl@SignupViaEmail');

});

Route::get('/verify-mailid/{key}', 'Frontend\FrontendReqstCtrl@MailVerify')->name('verify.email'); //verify email id from mail redirected link
Route::post('/user/logout', 'Frontend\AjaxCtrl@UserLogout');



/*-----------------------------------------------------------------------------------------------------
|front-end registered customers' accessible pages
|------------------------------------------------------------------------------------------------------
*/
Route::prefix('user')->middleware('userloggedin')->group(function() {

	Route::get('/dashboard', 'Frontend\UserPagesCtrl@index')->name('user.dashboard');
	Route::get('/set-password', 'Frontend\UserPagesCtrl@InitPassword');
	Route::put('/request/set-password', 'Frontend\UserRqstCtrl@InitPassword');
	Route::get('/change-password', 'Frontend\UserPagesCtrl@ChangePasswd');
	Route::put('/request/change-password', 'Frontend\UserRqstCtrl@ChangePasswd');
	Route::get('/profile', 'Frontend\UserPagesCtrl@UpdateProfile');
	Route::put('/request/update-profile', 'Frontend\UserRqstCtrl@UpdateProfile');
	Route::get('/my-reviews', 'Frontend\UserPagesCtrl@ListReviews');
	Route::get('/review/edit/{id}', 'Frontend\UserPagesCtrl@EditReview');
	Route::put('/request/review-edit/{id}', 'Frontend\UserRqstCtrl@EditReviewRq');
	Route::get('/review/share', 'Frontend\UserPagesCtrl@AddReview');
	Route::post('/request/review-add', 'Frontend\UserRqstCtrl@AddReviewRq');
	Route::get('/my-orders', 'Frontend\UserPagesCtrl@ListOrders');
	Route::get('/my-order/{token}', 'Frontend\UserPagesCtrl@OrderDetails');

});


/*-----------------------------------------------------------------------------------------------------
|admin access routes
|------------------------------------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function() {

	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'Backend\AdminController@index')->name('admin.dashboard');
	Route::get('/profile', 'Backend\AdminController@profile')->name('admin.profile');
	Route::put('/profile/update-personal-info', 'Backend\ProfileCtrl@update')->name('admin.profile.update');
	Route::put('/profile/update-password', 'Backend\ProfileCtrl@PasswordUpdate')->name('admin.profile.password');

	//forgot password & reset
    Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

	//manage category
	Route::get('/category/manage', 'Backend\AdminController@ManageCategory');
	Route::get('/category/add', 'Backend\AdminController@AddCategory');
	Route::post('/request/category/add', 'Backend\RequestHandlers\AdminRqstController@AddCategory');
	Route::get('/category/edit/{id}', 'Backend\AdminController@EditCategory');
	Route::put('/request/category/edit/{id}', 'Backend\RequestHandlers\AdminRqstController@EditCategory');
	Route::get('/category/sort-products/{id}', 'Backend\AdminController@ReorderProducts');
	Route::put('/category/set-order', 'Backend\RequestHandlers\AdminRqstController@SortNavOrder');
	Route::delete('/category/delete', 'Backend\RequestHandlers\AdminRqstController@RemoveCategory');

	//manage products
	Route::get('/product/manage', 'Backend\AdminController@ManageProduct');
	Route::get('/product/add', 'Backend\AdminController@AddProduct');
	Route::post('/request/product/add', 'Backend\RequestHandlers\AdminRqstController@AddProduct');
	Route::get('/product/edit/{id}', 'Backend\AdminController@EditProduct');
	Route::put('/request/product/edit/{id}', 'Backend\RequestHandlers\AdminRqstController@EditProduct');
	Route::put('/product/set-order', 'Backend\RequestHandlers\AdminRqstController@SortOrder');
	Route::delete('/product/delete', 'Backend\RequestHandlers\AdminRqstController@RemoveProduct');

	//manage product reviews
	Route::get('/product/reviews/{publishstate}', 'Backend\AdminController@ManageReviews');
	Route::put('/product/review/toggle-publish', 'Backend\RequestHandlers\AdminRqstController@ToggleReviewState');
	Route::delete('/product/review/delete', 'Backend\RequestHandlers\AdminRqstController@DeleteReview');
	Route::get('/product/review/update/{id}', 'Backend\AdminController@EditReview');
	Route::put('/request/product/review/update/{id}', 'Backend\RequestHandlers\AdminRqstController@EditReviewRq');

	//manage various form field options
	Route::get('/form/paperstock', 'Backend\AdminController@FormPaperstock');
	Route::get('/form/size', 'Backend\AdminController@FormSize');
	Route::get('/form/qty', 'Backend\AdminController@FormQuantity');
	Route::post('/form/insert/paperstock', 'Backend\RequestHandlers\AdminRqstController@PaperstockInsert');
	Route::delete('/form/remove/paperstock', 'Backend\RequestHandlers\AdminRqstController@PaperstockRemove');
	Route::post('/form/insert/size', 'Backend\RequestHandlers\AdminRqstController@SizeInsert');
	Route::delete('/form/remove/size', 'Backend\RequestHandlers\AdminRqstController@SizeRemove');
	Route::post('/form/insert/qty', 'Backend\RequestHandlers\AdminRqstController@QtyInsert');
	Route::delete('/form/remove/qty', 'Backend\RequestHandlers\AdminRqstController@QtyRemove');
	Route::get('/form/paperstock/edit/{id}', 'Backend\AdminController@EditFormPaperstock');
	Route::get('/form/size/edit/{id}', 'Backend\AdminController@EditFormSize');
	Route::put('/form/update/paperstock/{id}', 'Backend\RequestHandlers\AdminRqstController@PaperstockUpdate');
	Route::put('/form/update/size/{id}', 'Backend\RequestHandlers\AdminRqstController@SizeUpdate');
	Route::get('/form/editoption/{prod_id}/{fld_type_id}/{prod_form_map_id}', 'Backend\AdminController@EditFormFieldMapping');
	Route::put('/form/set/options/{mapid}', 'Backend\RequestHandlers\AdminRqstController@OptMapUpdate');
	Route::put('/form/sort/fieldoption', 'Backend\RequestHandlers\AdminRqstController@SortFieldOption');
	Route::get('/form/lamination', 'Backend\AdminController@VisitLaminationOptions');
	Route::post('/form/insert/lamination', 'Backend\RequestHandlers\AdminRqstController@LaminationInsert');
	Route::delete('/form/remove/lamination', 'Backend\RequestHandlers\AdminRqstController@LaminationRemove');
	Route::put('/form/sort/lamination', 'Backend\RequestHandlers\AdminRqstController@SortLamination');

	Route::get('/form/sticker-type', 'Backend\AdminController@VisitStickerTypes');
	Route::post('/form/insert/sticker-type', 'Backend\RequestHandlers\AdminRqstController@StickerTypesInsert');
	Route::delete('/form/remove/sticker_type', 'Backend\RequestHandlers\AdminRqstController@StickerTypesRemove');
	Route::put('/form/sort/sticker-type', 'Backend\RequestHandlers\AdminRqstController@SortStickerTypes');
	Route::get('/form/edit/sticker-type/{id}', 'Backend\AdminController@EditStickerType');
	Route::put('/form/update/sticker-type/{id}', 'Backend\RequestHandlers\AdminRqstController@EditRqStickerType');

	//manage pricing presets
	Route::get('/product/presets/{prod_id}', 'Backend\PricingRules@RuleOptions');

	Route::get('/product/presets/general/{prod_id}', 'Backend\PricingRules@GeneralSetup');
	Route::get('/product/presets/general/list/{prod_id}', 'Backend\PricingRules@GeneralList');
	Route::post('/product/presets/general/post/{prod_id}', 'Backend\PricingRules@RqGeneralSetup');
	Route::delete('/product/presets/general/remove', 'Backend\PricingRules@RmvGeneralPreset');
	Route::get('/product/presets/general/edit/{preset_id}/{product_id}', 'Backend\PricingRules@EditPageGenPreset');
	Route::put('/product/presets/general/edit-rq/{preset_id}/{product_id}', 'Backend\PricingRules@EditGenPreset');

	Route::get('/product/presets/qty-rule-first/{prod_id}', 'Backend\PricingRules@QtyRuleOneSetup');
	Route::get('/product/presets/qty-rule-first/list/{prod_id}', 'Backend\PricingRules@QtyRuleOneList');
	Route::post('/product/presets/qty-rule-first/post/{prod_id}', 'Backend\PricingRules@RqQtyRuleOneSetup');
	Route::get('/product/presets/qty-rule-first/edit/{preset_id}/{product_id}', 'Backend\PricingRules@EditPageQtyRuleOnePreset');
	Route::put('/product/presets/qty-rule-first/edit-rq/{preset_id}/{product_id}', 'Backend\PricingRules@EditQtyRuleOnePreset');

	Route::get('/product/presets/qty-rule-sec/{prod_id}', 'Backend\PricingRules@QtyRuleTwoSetup');
	Route::get('/product/presets/qty-rule-sec/list/{prod_id}', 'Backend\PricingRules@QtyRuleTwoList');
	Route::post('/product/presets/qty-rule-sec/post/{prod_id}', 'Backend\PricingRules@RqQtyRuleTwoSetup');
	Route::get('/product/presets/qty-rule-sec/edit/{preset_id}/{product_id}', 'Backend\PricingRules@EditPageQtyRuleTwoPreset');
	Route::put('/product/presets/qty-rule-sec/edit-rq/{preset_id}/{product_id}', 'Backend\PricingRules@EditQtyRuleTwoPreset');

	//order related
	Route::get('/order/manage/{status}', 'Backend\OrderCtrl@Visit')->where('status', '(completed|pending)');
	Route::get('/order-details/{id}', 'Backend\OrderCtrl@OrderDetails')->name('order.details');
	Route::post('/order/manage/download-artwork', 'Backend\OrderCtrl@DownloadArtwork')->name('download.artwork');
	Route::put('/order/update-status', 'Backend\OrderCtrl@UpdateStatus');
	Route::delete('/order/manage/delete', 'Backend\OrderCtrl@DeleteOrder')->name('order.delete');

	Route::get('/settings/notification', 'Backend\SettingsCtrl@Visit');
	Route::put('/settings/notification/save', 'Backend\SettingsCtrl@SaveSettings');

	Route::get('/customer/manage', 'Backend\AdminController@ManageCustomers')->name('manage.customers');

	//the CMS pages
	Route::get('/cms/add-page', 'Backend\AdminController@CMSAddPage');
	Route::post('/cms/pageadd', 'Backend\RequestHandlers\AdminRqstController@AddPage');
	Route::get('/cms/edit-page/{id}', 'Backend\AdminController@EditPage');
	Route::put('/cms/edit-submit/{id}', 'Backend\RequestHandlers\AdminRqstController@EditPage');
	Route::get('/cms/list-pages', 'Backend\AdminController@CMSPagesList');
	Route::delete('/cms/manage-page/delete/{id}', 'Backend\RequestHandlers\AdminRqstController@RemovePage');
	Route::get('/cms/manage-home', 'Backend\AdminController@CMSManageHomeBanner');
	Route::post('/cms/home/banner', 'Backend\RequestHandlers\AdminRqstController@CMSManageHomeBanner');
	Route::get('/cms/product-links', 'Backend\AdminController@CMSManageProdLinks');
	Route::post('/cms/product-links/save', 'Backend\RequestHandlers\AdminRqstController@CMSSaveProdLinks');


	/*___________________________________________________
	| Super admin can add new, delete or inactive admin
	|----------------------------------------------------
	*/
	Route::get('/user/manage-list-admins', 'Backend\AdminController@ListUsers')->name('manage.admins')->middleware('onlysuperadmin');
	Route::get('/user/add-new', 'Backend\AdminController@AddUser')->name('add.new.admin.page')->middleware('onlysuperadmin');
	Route::post('/user/new-add-request', 'Backend\RequestHandlers\ManageAdmins@AddNewAdmin')->name('add.new.admin.request')->middleware('onlysuperadmin');
	Route::put('/user/toggle-active', 'Backend\RequestHandlers\ManageAdmins@ToggleAdmin')->name('admin.user.toggle')->middleware('onlysuperadmin');
	Route::get('/user/remove-account/{id}', 'Backend\RequestHandlers\ManageAdmins@RemoveAdmin')->name('admin.remove')->middleware('onlysuperadmin');


	//access elfinder file manager
	Route::get('/manage-media', 'Backend\AdminController@MediaManager')->name('elfinder');
	Route::get('/ckeditor-media', 'Backend\AdminController@CkeditorMediaManager')->name('elfinder-ckeditor');

});



/*___________________________________________________
| category page and product page dynamic URL
|----------------------------------------------------
*/
Route::get('/{slug}', 'Frontend\PagesCtrl@category'); //can be category or CMS page
Route::get('/{categorySlug}/{prodSlug}', 'Frontend\PagesCtrl@product');
