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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', fn() => redirect('/assignment05'));
Route::get('/assignment05', 'Assignment05@homepage');
Route::get('/assignment05/search', 'Assignment05@search');
Route::get('/assignment05/product/{proId}', 'Assignment05@product');
Route::get('/assignment05/sign-in', 'Assignment05@signIn');
Route::post('/assignment05/sign-in', 'Assignment05@signedIn');
Route::get('/assignment05/sign-up', 'Assignment05@signUp');
Route::post('/assignment05/sign-up', 'Assignment05@signedUp');
Route::get('/assignment05/sign-out', 'Assignment05@signOut');
