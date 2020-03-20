<?php

Route::post('/add-cart', 'User@addCart');
Route::get('/cart', 'User@cartView');
Route::get('/order', 'User@orderView');
Route::get('/checkout', 'User@checkoutView');
Route::post('/checkout', 'User@checkout');
