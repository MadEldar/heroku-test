<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Product;
use App\Mail\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class User extends Controller
{
    private function getCart() {
        $cart = session()->get('cart');
        return isset($cart) ? $cart : [];
    }

    private function populateCart($cart) {
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
        $currentProduct = Product::find($req->get('id'));
        if ($req->get('quantity') > $currentProduct->quantity)
            return redirect()->back()->withErrors(["This product only has $currentProduct->quantity more in stocks"]);
        $cart = $this->getCart();
        $product = array_filter($cart, fn($pro) => $pro['id'] == $req->get('id'));
        $product = $product == [] ? null : array_splice($cart, array_search(array_shift($product), $cart), 1)[0];
        if (isset($product)) {
            $product['quantity'] += $req->get('quantity');
            if ($product['quantity'] > $currentProduct->quantity)
                return redirect()->back()->withErrors(["The total amount of this product in your cart exceeds current quantity"]);
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
        $cart = $this->populateCart($this->getCart());
        if (!isset($cart[0])) return redirect('/')->withErrors(['The cart is empty']);
        return view('cart', [
            'title' => 'User - Cart',
            'cart' => $cart
        ]);
    }

    public function checkoutView(Request $req) {
        $cart = $this->populateCart($this->getCart());
        return view('checkout', [
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
        $cart = $this->populateCart($this->getCart());
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
        Mail::to($order->email)->send(new OrderCreated($order));
        session()->forget('cart');
        return redirect('/user/orders#' . $order->id);
    }

    public function orderView() {
        return view('order', [
            'title' => 'User - Order',
            'orders' => Auth::user()->Orders
        ]);
    }

    public function reorder(Request $req) {
        $addToCart = array_map(
            fn($item) => [
                'id' => $item['product_id'],
                'quantity' => $item['quantity']
            ], Order::find($req->get('id'))->Items->toArray()
        );
        $cart = $this->getCart();
        foreach ($addToCart as $item) {
            $pro = array_filter($cart, fn($pro) => $pro['id'] == $item['id']);
            if (array_key_first($pro) < 0 || $pro == []) $cart[] = $item;
            else $cart[key($pro)]['quantity'] += $item['quantity'];
        }
        session(['cart' => $cart]);
        return redirect('/user/cart');
    }

    public function cancel(Request $req) {
        $order = Order::find($req->get('id'));
        foreach ($order->Items->toArray() as $pro) {
            Product::where('id', $pro['product_id'])->increment('quantity', $pro['quantity']);
        }
        $order->status = 5;
        $order->save();
        return redirect('/user/orders');
    }

    public function signOut() {
        session()->flush();
        return redirect()->back();
    }
}
