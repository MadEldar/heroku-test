<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['brand_name'];

    public static function getProducts($brandId, $quantity) {
        $brand = json_decode(Brand::where('id', $brandId)->select('id', 'brand_name as name')->take(1)->get()[0]);
        $brand->products = json_decode(Product::where('brand_id', $brandId)->take($quantity)->get(), true);
        return $brand;
    }

    public function Products() {
        return $this->hasMany("\App\Product");
    }
}
