@extends('frontend.layouts.master')

@section('content')

    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>

                        <div class="mb-3">
                            <label for="username">Name : {{ $address->user->name }} </label>
                        </div>
                        <div class="mb-3">
                            <label for="username">Phone : {{ $address->user->phone }} </label>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address : {{ $address->address }}</label>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Township : {{ $address->township }}</label>
                        </div>

                    </div>

                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Delivered address</h3>
                        </div>
                        <div class="mb-3">
                            <label for="username">Name : {{ $deli_address->user->name }} </label>
                        </div>
                        <div class="mb-3">
                            <label for="username">Phone : {{ $deli_address->user->phone }} </label>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address : {{ $deli_address->address }}</label>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Township : {{ $deli_address->township }}</label>
                        </div>
                    </div>




                </div>


                <div class="col-sm-12 col-lg-8 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">

                                <div class="title-left">
                                    <h3>Payment Method</h3>
                                </div>
                                <div class="d-block my-3">
                                    <p>  {{ Str::upper($order->payment_method) }}</p>
                                </div>

                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    @php
                                        $total_amount = 0;
                                    @endphp
                                    @foreach ($order->orderProducts as $product)
                                        <div class="media mb-2 border-bottom">
                                            <div class="media-body"><a href="detail.html">
                                                    {{ $product->product_name }}</a>
                                                <div class="___class_+?42___">
                                                    Size: {{ $product->product_size }} <span
                                                        class="mx-2">|</span>
                                                    Price: {{ $product->product_price }} MMK <span
                                                        class="mx-2">|</span>
                                                    Qty: {{ $product->product_quantity }} <span
                                                        class="mx-2">|</span>
                                                    Subtotal: {{ $product->product_price * $product->product_quantity }}
                                                    MMK
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $total_amount = $total_amount + $product->product_price * $product->product_quantity;
                                        @endphp



                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> @php
                                        echo $total_amount . ' MMK';
                                    @endphp </div>
                                </div>

                                <div class="d-flex">
                                    <h4>Delivery Cost ({{ $deli_address->city->city }})</h4>
                                    <div class="ml-auto font-weight-bold"> + {{$order->delivery_charge}} MMK </div>
                                </div>

                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> - {{$order->cupon_amount}}
                                        MMK </div>
                                </div>


                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> {{$order->grand_total}} </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
