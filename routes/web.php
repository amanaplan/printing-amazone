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
Route::post('/product/give-review', 'Frontend\UserReviewPost');

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

	//manage products
	Route::get('/product/manage', 'Backend\AdminController@ManageProduct');
	Route::get('/product/add', 'Backend\AdminController@AddProduct');
	Route::post('/request/product/add', 'Backend\RequestHandlers\AdminRqstController@AddProduct');
	Route::get('/product/edit/{id}', 'Backend\AdminController@EditProduct');
	Route::put('/request/product/edit/{id}', 'Backend\RequestHandlers\AdminRqstController@EditProduct');
	Route::put('/product/set-order', 'Backend\RequestHandlers\AdminRqstController@SortOrder');

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
	Route::post('/form/insert/size', 'Backend\RequestHandlers\AdminRqstController@SizeInsert');
	Route::post('/form/insert/qty', 'Backend\RequestHandlers\AdminRqstController@QtyInsert');
	Route::get('/form/paperstock/edit/{id}', 'Backend\AdminController@EditFormPaperstock');
	Route::get('/form/size/edit/{id}', 'Backend\AdminController@EditFormSize');
	Route::put('/form/update/paperstock/{id}', 'Backend\RequestHandlers\AdminRqstController@PaperstockUpdate');
	Route::put('/form/update/size/{id}', 'Backend\RequestHandlers\AdminRqstController@SizeUpdate');
	Route::get('/form/editoption/{prod_id}/{fld_type_id}/{prod_form_map_id}', 'Backend\AdminController@EditFormFieldMapping');
	Route::put('/form/set/options/{mapid}', 'Backend\RequestHandlers\AdminRqstController@OptMapUpdate');
	Route::put('/form/sort/fieldoption', 'Backend\RequestHandlers\AdminRqstController@SortFieldOption');


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

});



/*___________________________________________________
| category page and product page dynamic URL
|----------------------------------------------------
*/
Route::get('/{slug}', 'Frontend\PagesCtrl@category');
Route::get('/{categorySlug}/{prodSlug}', 'Frontend\PagesCtrl@product');
