<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use mysqli;

class Assignment05 extends Controller
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
        return view('assignment05/homepage', [
            'title' => 'Daily Shop - Homepage',
            'categories' => json_decode($categories, true),
            'products' => [
                'latest' => json_decode($latest),
                'highCost' => json_decode($highCost),
                'lowCost' => json_decode($lowCost),
            ]
        ]);
    }

    public function search() {
        if (isset($_GET['cat'])) {
            $id = $_GET['cat'];
            $result = Category::getProducts($id, 21);
        } else if (isset($_GET['brand'])) {
            $id = $_GET['brand'];
            $result = Brand::getProducts($id, 21);
        }
        $cat = Category::take(5)
            ->withCount('Products')
            ->orderBy('products_count', 'desc')
            ->get();
        $brand = Brand::take(5)
            ->withCount('Products')
            ->orderBy('products_count', 'desc')
            ->get();
        return view('assignment05/search', [
            'title' => $result->name . ' - Category',
            'result' => $result,
            'top_5' => [
                'cat' => $cat,
                'brand' => $brand
            ]
        ]);
    }

    public function product($proId) {
        $product = Product::where('id', $proId)->get()[0];
        $same_brand = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $proId)
            ->take(8)
            ->get();
        $same_category = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $proId)
            ->take(8)
            ->get();
        return view('assignment05/product', [
            'title' => $product->product_name . ' - Product details',
            'product' => $product,
            'same_brand' => $same_brand,
            'same_category' => $same_category,
        ]);
    }
}
