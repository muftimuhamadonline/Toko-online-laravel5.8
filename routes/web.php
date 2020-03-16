<?php

use App\Http\Middleware\CheckMember;
use App\Http\Middleware\CheckAdmin;
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

// Home Page
Route::get('/', 'pagesController@home');
Route::get('/mbuh', 'HomeController@methodA');
Route::get('/mbuh1', 'HomeController@methodB');

// Route Filter
Route::get('filter/{id}','pagesController@filter')->name('filter');

// About Page
Route::get('/about', 'pagesController@about');

// Shop Product Page
Route::group(['prefix' => 'shop'], function()
{
	Route::get('/', 'ShopController@index');

	// Quick view Product Page
	Route::get('{id}', 'ShopController@show');

	// Melakukan Pencarian 
	Route::get('cari','ShopController@search');

	//Filter kategori
	Route::get('kategori/{id}', 'ShopController@kategori');

	// Details product
	Route::get('product-details/{id}', 'ShopController@detailsProduct');
});


// Cart Page
Route::group(['prefix' => 'cart', 'middleware' => ['member']], function()
{
	Route::get('/', 'CartController@index');
	Route::post('addtocart', 'CartController@store');
	Route::post('update/{id}', 'CartController@update');
	Route::get('delete/{id}', 'CartController@destroy');
	Route::get('checkout', 'CartController@checkout');
	Route::get('checkout/{id}', 'CartController@kota');
	Route::get('/checkout/ongkir/{id}', 'CartController@ongkir');
	Route::get('/cart/delete/coupon/{id}', 'CartController@deleteCoupon');
	Route::post('checkout/purchase', 'OrderController@purchase');
	Route::post('coupon', 'CartController@coupon');

	// Load ajax
	Route::get('total/{id}', 'CartController@cartTotal');
	Route::get('final', 'CartController@totalOrder');

});

Route::get('getcart', 'pagesController@getdata');

// Login and Register Page
Route::get('/login-register', 'pagesController@loginregister')->name('login-custom');

// Profile Page
Route::prefix('profile')->middleware(CheckMember::class)->group(function(){
	Route::post('/changepassword', 'User\profileController@changePassword')->name('changepassword');
	Route::get('/', 'User\profileController@index')->name('profile');
	Route::get('/loadProfile', 'User\profileController@loadProfile');
	Route::get('/address', 'User\profileController@address');
	Route::get('/loadPassword', 'User\profileController@loadPassword');
	Route::get('/loadImage', 'User\profileController@loadImage');
	Route::post('/changeprofile/{id}', 'User\profileController@changeprofile')->name('change');
	Route::post('/uploadImage/{id}', 'User\profileController@uploadImage')->name('changeImage');
	Route::post('/changeaddress', 'User\profileController@changeaddress')->name('changeaddress');
});




// Order User Page
Route::group(['prefix' => 'orders', 'middleware' => ['member']], function() {
	Route::get('/', 'pagesController@orders');
	Route::get('/history', 'pagesController@historyorders');
	Route::post('/details/uploadpayment', 'OrderController@uploadpayment');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['admin']], function()
{
	// Dashboard Home
	Route::get('/', 'Admin\AdminController@index');

	// Category
	Route::get('category', 'Admin\CategoryController@index');
	Route::post('category/add', 'Admin\CategoryController@store');
	Route::post('category/edit/{id}', 'Admin\CategoryController@update');
	Route::get('category/delete/{id}', 'Admin\CategoryController@destroy');
	Route::get('category/loadcategory', 'Admin\CategoryController@loadCategory');

	// Products
	Route::get('products', 'Admin\ProductController@index');
	Route::post('products', 'Admin\ProductController@sort');
	Route::post('products/add', 'Admin\ProductController@store');
	Route::get('products/edit/{id}', 'Admin\ProductController@edit');
	Route::post('products/edit/{id}', 'Admin\ProductController@update');
	Route::get('products/delete/{id}', 'Admin\ProductController@destroy');
	Route::get('products/{sort}', 'Admin\ProductController@sort');

	// Users
	Route::get('users', 'Admin\UserController@index');
	Route::get('users/adduser', 'Admin\UserController@adduser');
	Route::post('users/add', 'Admin\UserController@store');

	// Orders
	Route::get('orders', 'Admin\OrderController@index');
	Route::get('orders/filter/{status}', 'Admin\OrderController@filter')->name('filter');
	Route::get('orders/details-order/{id}', 'Admin\OrderController@show');
	Route::post('orders/update/{id}', 'Admin\OrderController@update');


	// Template
	Route::get('changetemplate', 'Admin\TemplateController@index');
	Route::post('changetemplate/{id}', 'Admin\TemplateController@update');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
