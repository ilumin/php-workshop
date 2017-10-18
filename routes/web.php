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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin\Products
Route::get('/admin/product', 'Admin\ProductController@index');
Route::get('/admin/product/create', 'Admin\ProductController@create');
Route::post('/admin/product', 'Admin\ProductController@store');
Route::get('/admin/product/{id}', 'Admin\ProductController@edit');
Route::post('/admin/product/{id}', 'Admin\ProductController@update');
Route::delete('/admin/product/{id}', 'Admin\ProductController@update');
