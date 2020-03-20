<?php

Route::get('/home', "Admin@Home");

Route::get('/categories', "Admin@Category");
Route::post('/categories/create', "Admin@CategoryCreate");
Route::post('/categories/edit', "Admin@CategoryEdit");
Route::post('/categories/delete', "Admin@CategoryDelete");

Route::get('/brands', "Admin@Brand");
Route::post('/brands/create', "Admin@BrandCreate");
Route::post('/brands/edit', "Admin@BrandEdit");
Route::post('/brands/delete', "Admin@BrandDelete");

Route::get('/products', "Admin@Product");
Route::post('/products/create', "Admin@ProductCreate");
Route::post('/products/edit', "Admin@ProductEdit");
Route::post('/products/delete', "Admin@ProductDelete");

Route::get('/users', "Admin@User");
Route::post('/users/create', "Admin@UserCreate");
Route::post('/users/edit', "Admin@UserEdit");
Route::post('/users/delete', "Admin@UserDelete");

Route::get('/modal', "Admin@Modal");
