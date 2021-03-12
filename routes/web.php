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

Route::get('/', function () {
    return view('client.home');
});

//Auth::routes(['register' => false]);
Route::get('admin', 'Auth\LoginController@showLoginForm')->name('admin');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Reset password
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

//Email Verificaton Route
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

//Admin after login
Route::get('/dashboard','Admin@showDashboard')->name('dashboard');
Route::get('post/all','Post@allPost')->name('post.all');
Route::get('post/add','Post@addPost')->name('post.add');

//Work with categories
Route::get('post/category','Post@allCategory')->name('post.category.all');
Route::get('post/category/getAll','Post@getAllCategory')->name('post.category.getAll');
Route::get('post/category/getOne/{id}','Post@getOneCategory')->name('post.category.getOne');
Route::post('post/category/update','Post@updateCategory')->name('post.category.update');
Route::post('post/category/add','Post@addCategory')->name('post.category.add');
Route::post('post/category/delete','Post@deleteCategory')->name('post.category.delete');
Route::get('post/category/fillCatSelect/{id}','Post@fillCatSelect')->name('post.category.fillCatSelect');
Route::get('post/category/test/view',function (){
    return view('admin.post.test');
});

//Work with post
Route::post('post/upload/image','Post@uploadImage')->name('post.upload.image');
Route::post('post/save','Post@savePost')->name('post.save');


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

