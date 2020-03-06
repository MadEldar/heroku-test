<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name'];

    public static function getAllProducts($catId) {
        $category = json_decode(Category::where('id', $catId)->take(1)->get()[0]);
        $category->products = json_decode(Product::where('category_id', $catId)->take(21)->get(), true);
        return $category;
    }
}
