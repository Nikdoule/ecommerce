<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/getProduct/add/{slug}', 'Products\ProductsController@show');
Route::get('/getProduct/{slug}/edit', 'Products\ProductsController@edit');
Route::patch('/getProduct/{product}', 'Products\ProductsController@update');
Route::get('/getProduct', 'Products\ProductsController@index');
