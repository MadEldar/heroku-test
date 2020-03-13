<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Admin extends Controller
{
    public function Home() {
        return view("admin/home", [
            'title' => 'Admin - Home',
        ]);
    }

    public function Category() {
        $categories = Category::all();
        return view("admin/category", [
            'title' => 'Admin - Categories',
            'categories' => $categories
        ]);
    }
    public function CategoryCreate(Request $request) {
        $request->validate([
            'category_name' => 'required|string|unique:categories'
        ]);
        Category::create([
            'category_name' => $request->get('category_name')
        ]);
        return redirect()->to('/admin/categories');
    }
    public function CategoryEdit(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_name' => 'required|string|unique:categories'
        ]);
        Category::find($request->get('id'))
            ->update([
                'category_name' => $request->get('category_name')
            ]);
        return redirect()->to('/admin/categories');
    }

    public function Brand() {
        $brands = Brand::all();
        return view("admin/brand", [
            'title' => 'Admin - Brands',
            'brands' => $brands
        ]);
    }
    public function BrandCreate(Request $request) {
        $request->validate([
            'brand_name' => 'required|string|unique:brands'
        ]);
        Brand::create([
            'brand_name' => $request->get('brand_name')
        ]);
        return redirect()->to('/admin/brands');
    }
    public function BrandEdit(Request $request) {
        $request->validate([
            'id' => 'required',
            'brand_name' => 'required|string|unique:brands'
        ]);
        Brand::find($request->get('id'))
            ->update([
                'brand_name' => $request->get('brand_name')
            ]);
        return redirect()->to('/admin/brands');
    }

    public function Product() {
        $products = Product::all();
        return view('admin/product', [
            'title' => 'Admin - Products',
            'products' => $products
        ]);
    }
    public function ProductCreate(Request $request) {
        $request->validate([
            'product_name' => 'required|string|unique:products',
            'product_desc' => 'required',
            'product_thumbnail' => 'required',
            'product_gallery' => 'required',
            'brand_name' => 'required|exists:brands',
            'category_name' => 'required|exists:categories',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        Product::create([
            'product_name' => $request->get('product_name'),
            'product_desc' => $request->get('product_desc'),
            'product_thumbnail' => $request->get('product_thumbnail'),
            'product_gallery' => $request->get('product_gallery'),
            'brand_id' => $request->get('brand_id'),
            'category_id' => $request->get('category_id'),
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
        ]);
        return redirect()->to('/admin/products');
    }
    public function ProductEdit(Request $request) {
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($request->get('id'))
            ],
            'product_desc' => 'required',
            'product_thumbnail' => 'required',
            'product_gallery' => 'required',
            'brand_name' => 'required|exists:brands',
            'category_name' => 'required|exists:categories',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        Product::find($request->get('id'))
            ->update([
                'product_name' => $request->get('product_name'),
                'product_desc' => $request->get('product_desc'),
                'product_thumbnail' => $request->get('product_thumbnail'),
                'product_gallery' => $request->get('product_gallery'),
                'brand_id' => Brand::where('brand_name', $request->get('brand_name'))->get()[0]['id'],
                'category_id' => Category::where('category_name', $request->get('category_name'))->get()[0]['id'],
                'quantity' => $request->get('quantity'),
                'price' => $request->get('price'),
            ]);
        return redirect()->to('/admin/products');
    }

    public function Modal() {
        dd(number_format(Product::where('id', 1)->get()[0]['price'], 2));
        return view("admin/modal", [
            'title' => 'Admin - Modal',
        ]);
    }
}
