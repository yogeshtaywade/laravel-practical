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

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');    
    Route::resource('user', 'UserController');
    Route::match(['get', 'post'], 'ajax-image-upload', 'UserController@ajaxImage');
});
Route::middleware(['super-admin'])->group(function() {
    Route::resource('role', 'RoleController');
});
