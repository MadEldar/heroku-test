<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_desc',
        'product_thumbnail',
        'product_gallery',
        'category_id',
        'brand_id',
        'quantity',
        'price'
    ];

    public static function getProductWithCategory($proId) {
        return json_decode(Product::where('products.id', $proId)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->get()[0]);
    }
}
