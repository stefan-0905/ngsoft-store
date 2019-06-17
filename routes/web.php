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

Route::get('/', [
    'uses' => 'ProductController@index',
    'as' => 'products'
]);

Route::get('/create', [
    'uses' => 'ProductController@create',
    'as' => 'products.create'
]);

Route::post('/create', [
    'uses' => 'ProductController@store',
    'as' => 'products.store'
]);
