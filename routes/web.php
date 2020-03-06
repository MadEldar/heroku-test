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
Route::get('/assignment01', 'Assignment01@homepage');
Route::get('/assignment01/category', 'Assignment01@category');
Route::get('/assignment01/product', 'Assignment01@product');
