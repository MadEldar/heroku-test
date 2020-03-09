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

    public function Brand() {
        return $this->belongsTo("\App\Brand");
    }

    public function Category() {
        return $this->belongsTo("\App\Category");
    }
}
