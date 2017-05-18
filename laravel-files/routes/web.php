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
//Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
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
Route::post('/attempt/google-login', 'Frontend\AjaxCtrl@googleLogin');
Route::post('/attempt/google-signup', 'Frontend\AjaxCtrl@googleSignup');
Route::post('/user/logout', 'Frontend\AjaxCtrl@UserLogout');




/*-----------------------------------------------------------------------------------------------------
|front-end registered customers' accessible pages
|------------------------------------------------------------------------------------------------------
*/
Route::prefix('user')->group(function() {

	Route::get('/dashboard', 'Frontend\UserPagesCtrl@index')->name('user.dashboard');
	Route::get('/set-password', 'Frontend\UserPagesCtrl@InitPassword');
	Route::put('/request/set-password', 'Frontend\UserRqstCtrl@InitPassword');

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
