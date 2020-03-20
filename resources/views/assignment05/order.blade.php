<!DOCTYPE html>
<html lang="en">
@include('assignment05/layout/head')
<body>
@include('assignment05/layout/header')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="https://sourcepsd.com/wp-content/uploads/2019/09/Fashion-Banner-14522.jpg">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Cart</h2>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/assignment05') }}">Home</a></li>
                    <li class="active">Order</li>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkout-left">
                                <div class="panel-group" id="accordion">
                                    @php $last_item = end($orders)[0] @endphp
                                    @forelse($orders as $order)
                                        <!-- Order -->
                                        <div class="panel panel-default aa-checkout-billaddress">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{ $order->id }}">
                                                        {{ $order->created_at }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="{{ $order->id }}" class="panel-collapse collapse @if($last_item == $order) in @endif">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>First name:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>Last name:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-3">
                                                                    <p>Company:</p>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <p>Name</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>Email:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>Phone:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-3">
                                                                    <p>Address:</p>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-3">
                                                                    <p>Note:</p>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <p>Mark</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="cart-view-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @forelse($order->Items as $key=>$pro)
                                                                    @if(is_int($key))
                                                                        <tr>
                                                                            <td>
                                                                                <a class="aa-cart-title" href="{{ url("/assignment05/product/$pro->id") }}"
                                                                                   target="_blank">
                                                                                    {{ \App\Product::select('product_name')->where('id', $pro->id)->get()[0]->product_name }}
                                                                                </a>
                                                                            </td>
                                                                            <td>{{ number_format($pro->price, 2) }}</td>
                                                                            <td>{{ $pro->quantity }}</td>
                                                                            <td>${{ number_format($pro->quantity * $pro->price, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @empty
                                                                    <p>There is no product in the cart</p>
                                                                @endforelse
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
                                                                        ${{ $order->grand_total }}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h3>You have no past order</h3>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->

@include('assignment05/layout/footer')

@include('assignment05/layout/scripts')
</body>
</html>
