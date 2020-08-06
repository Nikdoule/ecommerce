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
    
    //Controller admin
    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
        Route::resource('/getUsers', 'UsersController');
        //View Admin
        Route::get('/users', 'UsersController@VIEW_INDEX')->name('users.index');
        Route::get('/users/{users}/edit', 'UsersController@VIEW_EDIT')->name('users.edit');
        
       
    });
    
    //Controller profil user
    Route::namespace('Profil')->prefix('edit')->name('profil.edit')->group(function() {

        Route::get('/getProfil', 'ProfilController@edit');
        Route::patch('/users/{user}', 'ProfilController@update')->name('.update');
        
    });
    // View profil
    Route::namespace('Profil')->prefix('edit')->name('edit.users')->group(function() {

        Route::get('/users', 'ProfilController@VIEW_EDIT');
        
    });

    //View products
    Route::get('/', 'Products\ProductsController@VIEW_INDEX')->name('products.index');

    Route::get('/product/create', 'Products\ProductsController@VIEW_CREATE')->name('products.create');

    Route::get('/product/{slug}', 'Products\ProductsController@VIEW_SHOW')->name('products.show');

    Route::get('/product/{product}/edit', 'Products\ProductsController@VIEW_EDIT')->name('products.edit');

    Route::get('/getProduct/add/{slug}', 'Products\ProductsController@show')->name('products.show.controller');

    Route::get('/getProduct/{slug}/edit', 'Products\ProductsController@edit')->name('products.edit.controller');

    Route::patch('/getProduct/{product}', 'Products\ProductsController@update')->name('products.update.controller');
    
    Route::get('/getProduct', 'Products\ProductsController@index')->name('products.index.controller');

    Route::get('/getProduct/create', 'Products\ProductsController@create')->name('products.create.controller');

    Route::post('/getProduct', 'Products\ProductsController@store')->name('products.store.controller');

    //view cart
    Route::get('/cart', 'CartController@VIEW_INDEX')->name('carts.index');
    
    //Controller carts

    Route::get('/getCarts', 'CartController@index');

    Route::post('/cart/add', 'CartController@store')->name('cart.store');

    Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');

    Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

    //Controller payement

    Route::get('/payment', 'CheckoutController@index')->name('checkout.index');
    
    Route::post('/payment', 'CheckoutController@store')->name('checkout.store');

    Route::get('/thankyou', 'CheckoutController@thankYou')->name('checkout.thankYou');

    Route::get('/getCategory/{slug}' , 'Products\ProductsController@getCategory');

    Route::get('/category/{slug}', 'Products\ProductsController@VIEW_CATEGORY');
    
});

Auth::routes(['verify' => true]);
