<?php

Route::get('/admin/home', "Admin@Home");
Route::get('/admin/categories', "Admin@Category");
Route::post('/admin/categories/create', "Admin@CategoryCreate");
Route::post('/admin/categories/edit', "Admin@CategoryEdit");
Route::get('/admin/brands', "Admin@Brand");
Route::post('/admin/brands/create', "Admin@BrandCreate");
Route::post('/admin/brands/edit', "Admin@BrandEdit");
Route::get('/admin/products', "Admin@Product");
Route::post('/admin/products/create', "Admin@ProductCreate");
Route::post('/admin/products/edit', "Admin@ProductEdit");
Route::get('/admin/modal', "Admin@Modal");
