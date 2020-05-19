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
    
    Route::namespace('Products')->group(function() {
        Route::resource('products', 'ProductsController');
    });
    Route::get('/', 'Products\ProductsController@index');
    Route::get('/products/{slug}', 'Products\ProductsController@show')->name('products.show');

    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
        Route::resource('users', 'UsersController');
    });
    Route::namespace('Profil')->prefix('profil')->name('profil.')->group(function() {
        Route::resource('users', 'ProfilController');
        
    });
    Route::namespace('Profil')->prefix('edit')->name('edit.users')->group(function() {
        Route::get('users', 'ProfilController@edit');
        
    });

    Route::get('/cart', 'CartController@index')->name('cart.index');

    Route::post('/cart/add', 'CartController@store')->name('cart.store');

    Route::post('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

    Route::get('/cart/delete', function() {
        Cart::destroy();
    });
    
});

Auth::routes(['verify' => true]);
