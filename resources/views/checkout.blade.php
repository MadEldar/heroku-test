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
                    <li class="active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="checkout-area">
                    <form action="{{ url('/user/checkout') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="checkout-left">
                                    <div class="panel-group" id="accordion">
                                        <!-- Coupon section -->
                                        <div class="panel panel-default aa-checkout-coupon">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Have a Coupon?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                                                    <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Shipping Address -->
                                        <div class="panel panel-default aa-checkout-billaddress">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        Shippping Address
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="text" placeholder="First Name*" name="name_first">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="text" placeholder="Last Name*" name="name_last">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="text" placeholder="Company name" name="company">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="email" placeholder="Email address" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="aa-checkout-single-bill">
                                                                <input type="tel" placeholder="Phone*" name="phone">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <textarea cols="8" rows="3" name="shipping_address" placeholder="Address*"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="aa-checkout-single-bill">
                                                                <textarea cols="8" rows="3" name="note" placeholder="Special Notes"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-right">
                                    <h4>Order Summary</h4>
                                    <div class="aa-order-summary-area">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($cart as $key=>$pro)
                                                @if(is_int($key))
                                                    <tr>
                                                        <td>{{ $pro->product_name }} <strong> x  {{ $pro->quantity }}</strong></td>
                                                        <td>${{ number_format($pro->total, 2) }}</td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <p>The cart is empty</p>
                                            @endforelse
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <td>${{ number_format($cart['sum'], 2) }}</td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <h4>Payment Method</h4>
                                    <div class="aa-payment-method">
                                        <label for="cashdelivery">
                                            <input type="radio" id="cashdelivery" name="payment_method" checked value="cash">
                                            Cash on Delivery
                                        </label>
                                        <label for="paypal">
                                            <input type="radio" id="paypal" name="payment_method" value="paypal">
                                            Via Paypal
                                        </label>
                                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" alt="PayPal Acceptance Mark">
                                        <input type="submit" value="Place Order" class="aa-browse-btn">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
