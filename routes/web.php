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
    
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
        Route::resource('users', 'UsersController');
    });
    Route::namespace('Profil')->prefix('profil')->name('profil.')->group(function() {
        Route::resource('users', 'ProfilController');
        
    });
    Route::namespace('Profil')->prefix('edit')->name('edit.users')->group(function() {
        Route::get('users', 'ProfilController@edit');
        
    });
    
    
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
