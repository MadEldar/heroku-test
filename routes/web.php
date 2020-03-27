<?php

use \Illuminate\Support\Facades\Auth;

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

Route::prefix('admin')->middleware('check_role')->group(function () {
    include_once("admin.php");
});

Route::prefix('user')->middleware('check_role')->group(function () {
    include_once("user.php");
});

Route::get('/', 'dailyShop@homepage');
Route::get('/search', 'dailyShop@search');
Route::get('/product/{proId}', 'dailyShop@product');
Route::get('/sign-in', 'dailyShop@signInView');
Route::post('/sign-in', 'dailyShop@signIn');
Route::get('/sign-up', 'dailyShop@signUpView');
Route::post('/sign-up', 'dailyShop@signUp');
Route::get('/sign-out', 'dailyShop@signOut');
