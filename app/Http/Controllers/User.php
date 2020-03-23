<?php

namespace App\Http\Controllers;

use App\Item;
use App\Mail\OrderCreated;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class User extends Controller
{
    private function getCart(Request $req) {
        $cart = $req->session()->get('cart');
        return isset($cart) ? $cart : [];
    }

    private function calculateCart($cart) {
        $cart = array_map(function ($pro) {
            $quantity = $pro['quantity'];
            $pro = Product::where('id', $pro['id'])->get()[0];
            $pro['quantity'] = $quantity;
            $pro['total'] = $pro['quantity'] * $pro['price'];
            return $pro;
        }, $cart);
        $cart['sum'] = array_reduce(
            array_map(
                fn($pro) => $pro['total'],
                $cart
            ),
            fn($sum, $cur) => $cur + $sum
        );
        return $cart;
    }

    public function addCart(Request $req) {
        $req->validate([
            'id' => 'required|exists:products',
            'quantity' => 'required|gt:0'
        ]);
        if ($req->get('quantity') > Product::find($req->get('id'))->quantity)
            return redirect()->back()->withErrors(['Selected quantity is more than stocks']);
        $cart = $this->getCart($req);
        $key = array_key_first(array_filter($cart, fn($pro) => $pro['id'] == $req->get('id')));
        $product = $key > 0 ? array_splice($cart, $key, 1) : [];
        $product = $product == [] ? null : $product[0];
        if (isset($product)) {
            $product['quantity'] += $req->get('quantity');
        } else {
            $product = [
                'id' => $req->get('id'),
                'quantity' => (int) $req->get('quantity')
            ];
        }
        $cart[] = $product;
        session(['cart' => $cart]);
        return redirect()->to('/user/cart');
    }

    public function cartView(Request $req) {
        $cart = $this->calculateCart($this->getCart($req));
        if (!isset($cart[0])) return redirect('/assignment05')->withErrors(['The cart is empty']);
        return view('/assignment05/cart', [
            'title' => 'User - Cart',
            'cart' => $cart
        ]);
    }

    public function checkoutView(Request $req) {
        $cart = $this->calculateCart($this->getCart($req));
        return view('/assignment05/checkout', [
            'title' => 'User - Checkout',
            'cart' => $cart
        ]);
    }

    public function checkout(Request $req) {
        $req->validate([
            'name_first' => 'required',
            'name_last' => 'required',
            'phone' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);
        $cart = $this->calculateCart($this->getCart($req));
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'name_first' => $req->get('name_first'),
            'name_last' => $req->get('name_last'),
            'company' => $req->get('company'),
            'email' => $req->get('email'),
            'phone' => $req->get('phone'),
            'note' => $req->get('note'),
            'shipping_address' => $req->get('shipping_address'),
            'payment_method' => $req->get('payment_method'),
            'status' => 0,
            'grand_total' => $cart['sum']
        ]);
        foreach ($cart as $key=>$pro) {
            if (is_int($key)) {
                Item::create([
                    'order_id' => $order->id,
                    'product_id' => $pro->id,
                    'quantity' => $pro->quantity,
                    'price' => $pro->price,
                ]);
                Product::where('id', $pro->id)->decrement('quantity', $pro->quantity);
            }
        }
        Mail::to('markskilink@gmail.com')->send(new OrderCreated());
        session()->forget('cart');
        return redirect('/user/orders');
    }

    public function orderView() {
        return view('assignment05/order', [
            'title' => 'User - Order',
            'orders' => Auth::user()->Orders
        ]);
    }

    public function reorder(Request $req) {
        $req->validate([
            'id' => 'required'
        ]);
        $addToCart = array_map(
            fn($item) => [
                'id' => $item['product_id'],
                'quantity' => $item['quantity']
            ], Order::find($req->get('id'))->Items->toArray()
        );
        $cart = $this->getCart($req);
        $merged = [];
        foreach ($addToCart as $item) {
            $pro = array_filter($cart, fn($pro) => $pro['id'] == $item['id']);
            dd(array_key_first($pro));
            if (array_key_first($pro) < 0) $merged[] = $item;
            else {
                $pro = $pro[array_key_first($pro)];
                $pro['quantity'] += $item['quantity'];
                $merged[] = $pro;
            }
        }
        dd($merged);
//        session(['cart' => $cart]);
        return redirect('/user/cart');
    }

    public function signOut() {
        session()->flush();
        return redirect()->back();
    }
}
