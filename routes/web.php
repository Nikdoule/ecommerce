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


Route::middleware('auth')->middleware('verified')->group(function(){
    
    //admin
    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {

        Route::resource('getUsers', 'UsersController');
        Route::resource('users', 'PageUsersController');
    });
    
    //user
    Route::namespace('Profil')->prefix('profil')->name('profil.')->group(function() {
        Route::resource('users', 'ProfilController');
        
    });
    Route::namespace('Profil')->prefix('edit')->name('edit.users')->group(function() {
        Route::get('users', 'ProfilController@edit');
        
    });

    //product
   
    Route::get('/', 'Products\PageProductsController@index')->name('products.index');

    Route::get('/getProducts', 'Products\ProductsController@index');
    
    Route::resource('/getProduct', 'Products\ProductsController');

    Route::resource('/product', 'Products\PageProductController');
    //cart
    Route::get('/cart', 'PageCartsController@index')->name('carts.index');
    
    Route::get('/getCarts', 'CartController@index');

    Route::post('/cart/add', 'CartController@store')->name('cart.store');

    Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');

    Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');


    //payement
    Route::get('/payment', 'CheckoutController@index')->name('checkout.index');
    
    Route::post('/payment', 'CheckoutController@store')->name('checkout.store');

    Route::get('/thankyou', 'CheckoutController@thankYou')->name('checkout.thankYou');

    
});

Auth::routes(['verify' => true]);
