<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name'];

    public static function getProducts($catId, $quantity) {
        $category = json_decode(Category::where('id', $catId)->select('id', 'category_name as name')->take(1)->get()[0]);
        $category->products = json_decode(Product::where('category_id', $catId)->take($quantity)->get(), true);
        return $category;
    }

    public function Products() {
        return $this->hasMany("\App\Product");
    }
}
