<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index');


// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::match(['get', 'post'], 'register2', 'Auth\RegisterController@register2');
Route::post('register/confirm', 'Auth\RegisterController@confirm');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('mypage','MyPageController@getUser')->name('mypage');
Route::get('mypage/listings','MyPageController@listings')->name('mypage.listings');
Route::get('mypage/profile', 'MyPageController@profile');
Route::get('mypage/profile/edit', 'MyPageController@edit');
Route::patch('mypage/profile/update', 'MyPageController@update');
Route::get('mypage/listing/{id}', 'MyPageController@listing')->name('listing.show');
Route::get('mypage/listing/{id}/edit','MyPageController@editProduct');
Route::patch('mypage/listing/productUpdate', 'MyPageController@productUpdate');
Route::post('mypage/product-status-switch', 'MyPageController@switch')->name('statusSwitch');
Route::get('mypage/purchaseHistory','MyPageController@purchaseHistory');
Route::post('mypage/delivery-notice', 'MyPageController@noticeDelivery')->name('noticeDelivery');
Route::get('mypage/purchase/{id}','MyPageController@purchase')->name('purchase.show');
Route::post('mypage/complete-transaction', 'MyPageController@completeTransaction')->name('completeTransaction');

Route::resource('product', 'ProductController');
Route::post('product/confirm', 'ProductController@confirm')->name('product.confirm');

Route::get('keyword', 'SearchController@keyword')->name('search.keyword');
Route::get('category/{id}', 'SearchController@category');

Route::get('shoppingcart', 'PurchaseController@cart')->name('purchase.cart');
Route::post('purchase/add', 'PurchaseController@add')->name('purchase.add');
Route::post('purchase/delete', 'PurchaseController@delete')->name('purchase.delete');
Route::post('purchase/decrease', 'PurchaseController@decrease')->name('purchase.decrease');
Route::get('input-send-info', 'PurchaseController@inputSendInfo')->name('input-send-info');
Route::match(['get', 'post'], 'input-settlement-info', 'PurchaseController@inputSettlementInfo')->name('input-settlement-info');
Route::post('purchase/confirm', 'PurchaseController@confirm')->name('purchase.confirm');
Route::post('determine', 'PurchaseController@determine')->name('purchase.determine');