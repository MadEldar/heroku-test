<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->unique()->name
    ];
});

$factory->define(\App\Brand::class, function (Faker $faker) {
    return [
        'brand_name' => $faker->unique()->name
    ];
});

$factory->define(\App\Product::class, function (Faker $faker) {
    $imageArray = [
        'https://previews.123rf.com/images/archinte/archinte1107/archinte110700009/9934761-blank-products-silhouette-set.jpg',
        'https://previews.123rf.com/images/rioabajorio/rioabajorio1904/rioabajorio190400240/122344977-set-of-various-containers-and-packages-silhouettes-beauty-products-vector-illustration-for-your-grap.jpg',
        'https://previews.123rf.com/images/leremy/leremy1206/leremy120600014/14173319-woman-female-makeup-cosmetic-product-silhouette-object.jpg',
        'https://previews.customer.envatousercontent.com/files/126136632/Set-of-silhouettes-of-containers-and-bottles-household-chemicals.jpg',
        'https://previews.customer.envatousercontent.com/files/127076216/Set-of-silhouettes-of-objects-garden-tools.jpg'
    ];
    return [
        'product_name' => $faker->unique()->name,
        'product_desc'  => $faker->sentence($nbWords = 20),
        'product_thumbnail' => $imageArray[array_rand($imageArray)],
        'product_gallery' => $imageArray[array_rand($imageArray)],
        'category_id' => $faker->numberBetween($min = 1, $max = 20),
        'brand_id' => $faker->numberBetween($min = 1, $max = 10),
        'quantity' => $faker->numberBetween($min = 1, $max = 100),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000)
    ];
});
