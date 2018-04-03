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
    return view('welcome');
});
Route::get('/login', function () {
    return view('app/pages.login.login');
});
Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::group(['middleware'=>'auth'], function (){

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController');
    Route::resource('product-category', 'ProductCategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('customer', 'CustomerController');
    Route::resource('order', 'OrderController');
    Route::resource('workshop-debt', 'WorkshopDebtController');
    Route::get('current-order', 'OrderController@currentOrders')->name('currentOrders');
    Route::get('order/invoice/{id}', 'OrderController@invoice')->name('orderInvoice');
    Route::get('customer-payment', 'CustomerPaymentController@index')->name('customerPayment.index');

    Route::post('order/attach-order-level/{orderId}',
        'OrderController@attachOrderLevel')->name('attachOrderLevel');
    Route::post('order/cargo-cost/{orderId}',
        'OrderController@updateCargoCost')->name('updateCargoCost');
    Route::post('order/payment/add/{orderId}',
        'OrderController@addPayment')->name('addPayment');

    Route::resource('general-cost', 'GeneralCostController');
    Route::get('order-image/{orderId}/create', 'OrderImageController@create');
    Route::post('order-image/{orderId}', 'OrderImageController@store');
    Route::get('order-image/{id}/edit', 'OrderImageController@edit');
    Route::patch('order-image/{id}', 'OrderImageController@update');
    Route::delete('order-image/{id}', 'OrderImageController@destroy');

    Route::get('/test', function (){
        //$user = Auth::user();
        //$user->assignRole('admin');
        //dd($user->getRoleNames());
    });
});


