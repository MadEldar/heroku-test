<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dailyShop extends Controller
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
        return view('homepage', [
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
        return view('search', [
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
        return view('product', [
            'title' => $product->product_name . ' - Product details',
            'product' => $product,
            'same_brand' => $same_brand,
            'same_category' => $same_category,
        ]);
    }

    public function signInView() {
        return view('sign-in', [
            'title' => 'Daily shop - Sign in'
        ]);
    }

    public function signIn(Request $req) {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $req->get('email'))->get()[0];
        if ($user->email == $req->get('email') && $user->password == $req->get('password')) {
            Auth::login($user, true);
            return redirect()->to('/');
        } else {
            $errors = [
                'Incorrect email or password'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function signUpView(Request $req) {
        return view('sign-up', [
            'title' => 'Daily shop - Sign up'
        ]);
    }

    public function signUp(Request $req) {
        $req->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|same:confirmation',
            'confirmation' => 'required'
        ]);
        User::create([
            'name' => $req->get('name'),
            'email' => $req->get('email'),
            'password' => $req->get('password'),
            'role' => 0,
        ]);
        return redirect()->to('/sign-in');
    }

    public function signOut()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
