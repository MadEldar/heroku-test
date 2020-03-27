<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<body>
@include('layout/header')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="https://sourcepsd.com/wp-content/uploads/2019/09/Fashion-Banner-14522.jpg">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Cart</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="cart-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
{{--                                    <th></th>--}}
                                    <th>Thumbnail</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cart as $key=>$pro)
                                    @if(is_int($key))
                                        <tr>
{{--                                            <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>--}}
                                            <td><a href="#"><img src="{{ $pro->product_thumbnail }}" alt="img"></a></td>
                                            <td>
                                                <a class="aa-cart-title" href="{{ url("/product/$pro->id") }}"
                                                target="_blank">
                                                    {{ $pro->product_name }}
                                                </a>
                                            </td>
                                            <td>{{ number_format($pro->price, 2) }}</td>
                                            <td>
{{--                                                <input class="aa-cart-quantity" type="number" value="{{ $pro->quantity }}">--}}
                                                {{ $pro->quantity }}
                                            </td>
                                            <td>${{ number_format($pro->total, 2) }}</td>
                                        </tr>
                                    @endif
                                @empty
                                    <p>There is no product in the cart</p>
                                @endforelse
{{--                                <tr>--}}
{{--                                    <td colspan="6" class="aa-cart-view-bottom">--}}
{{--                                        <div class="aa-cart-coupon">--}}
{{--                                            <input class="aa-coupon-code" type="text" placeholder="Coupon">--}}
{{--                                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">--}}
{{--                                        </div>--}}
{{--                                        <input class="aa-cart-view-btn" type="submit" value="Update Cart">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- Cart Total view -->
                        <div class="cart-view-total">
                            <h4>Cart Totals</h4>
                            <table class="aa-totals-table">
                                <tbody>
                                <tr>
                                    <th>Total</th>
                                    <td>
                                        ${{ $cart['sum'] }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{ url('/user/checkout') }}" class="aa-cart-view-btn">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->

@include('layout/footer')

@include('layout/scripts')
</body>
</html>
