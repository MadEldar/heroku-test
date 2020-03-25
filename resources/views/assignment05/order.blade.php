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
                                    @php
                                        $last_item = end($orders)[0];
                                        $convertStatus = function ($status) {
                                            switch ($status) {
                                                case 0: return 'Pending';
                                                case 1: return 'Confirmed';
                                                case 2: return 'Shipping';
                                                case 3: return 'Delivered';
                                                case 4: return 'Received';
                                                case 5: return 'Cancelled';
                                                default: return 'Unknown';
                                            }
                                        }
                                    @endphp
                                    @forelse($orders as $order)
                                        <!-- Order -->
                                        <div class="panel panel-default aa-checkout-billaddress">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{ $order->id }}">
                                                        <span>{{ $order->created_at }}</span>
                                                        <span style="float: right">{{ $convertStatus($order->status) }}</span>
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
                                                                    <p>{{ $order->name_first }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>Last name:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>{{ $order->name_last }}</p>
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
                                                                    <p>{{ $order->company }}</p>
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
                                                                    <p>{{ $order->email }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-checkout-single-bill">
                                                                <div class="col-md-4">
                                                                    <p>Phone:</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <p>{{ $order->phone }}</p>
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
                                                                    <p>{{ $order->shipping_address }}</p>
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
                                                                    <p>{{ $order->note }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom: 120px">
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
                                                                @foreach($order->Items as $pro)
                                                                    <tr>
                                                                        <td>
                                                                            <a class="aa-cart-title" href="{{ url("/assignment05/product/$pro->product_id") }}"
                                                                               target="_blank">
                                                                                {{ \App\Product::where('id', $pro->product_id)->select('product_name')->get()[0]->product_name }}
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ number_format($pro->price, 2) }}</td>
                                                                        <td>{{ $pro->quantity }}</td>
                                                                        <td>${{ number_format($pro->quantity * $pro->price, 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- Cart Total view -->
                                                        <div class="cart-view-total col-md-4" style="margin-left: 25%">
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
                                                        <div class="pull-right" style="margin-top: 40px">
                                                            <form action="{{ url('/user/reorder') }}" method="post" style="width: max-content; margin: 0 15px; display: inline-block">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                                <button class="aa-add-to-cart-btn" style="background-color: white; margin: auto"
                                                                type="submit">
                                                                    Reorder
                                                                </button>
                                                            </form>
                                                            @if($order->status < 2)
                                                                <form action="{{ url('/user/cancel') }}" method="post" style="width: max-content; margin: 0 15px; display: inline-block">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                                                    <button class="aa-add-to-cart-btn" style="background-color: white; margin: auto" type="submit">
                                                                        Cancel
                                                                    </button>
                                                                </form>
                                                            @endif
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
