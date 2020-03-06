<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use mysqli;

class Assignment01 extends Controller
{
    public function homepage() {
        $categories = Category::take(5)
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->select(
                'categories.id as id',
                'categories.category_name as name',
                'products.product_thumbnail as thumbnail',
                'products.product_desc as description'
            )
            ->get();
        $latest = Product::take(8)
            ->orderBy('created_at', 'desc')
            ->get();
        $highCost = Product::take(8)
            ->orderBy('price', 'desc')
            ->get();
        $lowCost = Product::take(8)
            ->orderBy('price', 'asc')
            ->get();
        return view('assignment01/homepage', [
            'title' => 'Daily Shop - Homepage',
            'categories' => json_decode($categories, true),
            'products' => [
                'latest' => json_decode($latest),
                'highCost' => json_decode($highCost),
                'lowCost' => json_decode($lowCost),
            ]
        ]);
    }

    public function category() {
        $catId = $_GET['cat'];
        $category = Category::getAllProducts($catId);
        $top_5 = Category::take(5)
            ->where('id', '!=', $catId)
            ->get();
        return view('assignment01/category', [
            'title' => $category->category_name . ' - Category',
            'category' => $category,
            'top_5' => $top_5
        ]);
    }

    public function product() {
        $proId = $_GET['pro'];
        $product = Product::getProductWithCategory($proId);
        $same_brand = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $proId)
            ->take(8)
            ->get();
        $same_category = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $proId)
            ->take(8)
            ->get();
        return view('assignment01/product', [
            'title' => $product->product_name . ' - Product details',
            'product' => $product,
            'same_brand' => $same_brand,
            'same_category' => $same_category,
        ]);
    }
}
