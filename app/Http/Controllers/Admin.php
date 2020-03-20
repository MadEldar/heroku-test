<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Product;
use App\User;
use DemeterChain\B;
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
    public function CategoryCreate(Request $req) {
        $req->validate([
            'category_name' => 'required|string|unique:categories'
        ]);
        Category::create([
            'category_name' => $req->get('category_name')
        ]);
        return redirect()->to('/admin/categories');
    }
    public function CategoryEdit(Request $req) {
        $req->validate([
            'id' => 'required',
            'category_name' => 'required|string|unique:categories'
        ]);
        Category::find($req->get('id'))
            ->update([
                'category_name' => $req->get('category_name')
            ]);
        return redirect()->to('/admin/categories');
    }
    public function CategoryDelete(Request $req) {
        Category::where('id', $req->get('id'))->delete();
        return redirect()->to('/admin/categories');
    }

    public function Brand() {
        $brands = Brand::all();
        return view("admin/brand", [
            'title' => 'Admin - Brands',
            'brands' => $brands
        ]);
    }
    public function BrandCreate(Request $req) {
        $req->validate([
            'brand_name' => 'required|string|unique:brands'
        ]);
        Brand::create([
            'brand_name' => $req->get('brand_name')
        ]);
        return redirect()->to('/admin/brands');
    }
    public function BrandEdit(Request $req) {
        $req->validate([
            'id' => 'required',
            'brand_name' => 'required|string|unique:brands'
        ]);
        Brand::find($req->get('id'))
            ->update([
                'brand_name' => $req->get('brand_name')
            ]);
        return redirect()->to('/admin/brands');
    }
    public function BrandDelete(Request $req) {
        Brand::where('id', $req->get('id'))->delete();
        return redirect()->to('/admin/brands');
    }

    public function Product() {
        return view('admin/product', [
            'title' => 'Admin - Products',
            'products' => Product::all(),
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }
    public function ProductCreate(Request $req) {
        $req->validate([
            'product_name' => 'required|string|unique:products',
            'product_desc' => 'required',
            'product_thumbnail' => 'required',
            'product_gallery' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        Product::create([
            'product_name' => $req->get('product_name'),
            'product_desc' => $req->get('product_desc'),
            'product_thumbnail' => $req->get('product_thumbnail'),
            'product_gallery' => $req->get('product_gallery'),
            'brand_id' => $req->get('brand_id'),
            'category_id' => $req->get('category_id'),
            'quantity' => $req->get('quantity'),
            'price' => $req->get('price'),
        ]);
        return redirect()->to('/admin/products');
    }
    public function ProductEdit(Request $req) {
        $req->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($req->get('id'))
            ],
            'product_desc' => 'required',
            'product_thumbnail' => 'required',
            'product_gallery' => 'required',
            'brand_name' => 'required|exists:brands',
            'category_name' => 'required|exists:categories',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        Product::find($req->get('id'))
            ->update([
                'product_name' => $req->get('product_name'),
                'product_desc' => $req->get('product_desc'),
                'product_thumbnail' => $req->get('product_thumbnail'),
                'product_gallery' => $req->get('product_gallery'),
                'brand_id' => Brand::where('brand_name', $req->get('brand_name'))->get()[0]['id'],
                'category_id' => Category::where('category_name', $req->get('category_name'))->get()[0]['id'],
                'quantity' => $req->get('quantity'),
                'price' => $req->get('price'),
            ]);
        return redirect()->to('/admin/products');
    }
    public function ProductDelete(Request $req) {
        Product::where('id', $req->get('id'))->delete();
        return redirect()->to('/admin/products');
    }

    public function User() {
        $users = User::all();
        return view("admin/user", [
            'title' => 'Admin - Users',
            'users' => $users
        ]);
    }
    public function UserCreate(Request $req) {
        $req->validate([
            'email' => 'required|string|unique:users',
            'role' => 'required',
            'password' => 'required',
            'name' => 'required'
        ]);
        User::create([
            'name' => $req->get('name'),
            'email' => $req->get('email'),
            'password' => $req->get('password'),
            'role' => $req->get('role')
        ]);
        return redirect()->to('/admin/users');
    }
    public function UserEdit(Request $req) {
        $req->validate([
            'id' => 'required',
            'email' => 'required|string|unique:users,email, ' . $req->get('id'),
            'role' => 'required',
            'name' => 'required'
        ]);
        User::find($req->get('id'))
            ->update([
                'name' => $req->get('name'),
                'email' => $req->get('email'),
                'role' => $req->get('role')
            ]);
        return redirect()->to('/admin/users');
    }
    public function UserDelete(Request $req) {
        User::where('id', $req->get('id'))->delete();
        return redirect()->to('/admin/users');
    }

    public function Modal() {
        dd(number_format(Product::where('id', 1)->get()[0]['price'], 2));
        return view("admin/modal", [
            'title' => 'Admin - Modal',
        ]);
    }
}
