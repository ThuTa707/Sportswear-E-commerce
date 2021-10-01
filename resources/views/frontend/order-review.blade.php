@extends('frontend.layouts.master')

@section('content')


    <!-- Start Cart  -->

    <form action="{{ route('orderConfirm') }}" method="POST">
        @csrf
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
                                {{-- <input type="hidden" class="form-control" id="address" placeholder="" required> --}}
                            </div>
                            <div class="mb-3">
                                <label for="address2">Township : {{ $deli_address->township }}</label>
                            </div>
                        </div>




                    </div>


                    <div class="col-sm-12 col-lg-8 mb-3">
                        <div class="row">
                            {{-- <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input"
                                            checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label>
                                        <span class="float-right font-weight-bold">FREE</span>
                                    </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input"
                                            type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label>
                                        <span class="float-right font-weight-bold">$10.00</span>
                                    </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input"
                                            type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label>
                                        <span class="float-right font-weight-bold">$20.00</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">

                                    <div class="title-left">
                                        <h3>Payment Method</h3>
                                    </div>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input id="debit" name="paymentMethod" value="cod" type="radio" class="custom-control-input"
                                                required>
                                            <label class="custom-control-label" for="debit">Cash On Delivery</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="paypal" value="stripe" name="paymentMethod" type="radio"
                                                class="custom-control-input" required>
                                            <label class="custom-control-label" for="paypal">Stripe</label>
                                        </div>
                                    </div>

                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                        @php
                                            $total_amount = 0;
                                        @endphp
                                        @foreach ($products as $product)
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"><a href="detail.html"> {{ $product->name }}</a>
                                                    <div class="___class_+?42___">
                                                        Size: {{ $product->size }} <span class="mx-2">|</span>
                                                        Price: {{ $product->price }} MMK <span
                                                            class="mx-2">|</span>
                                                        Qty: {{ $product->quantity }} <span class="mx-2">|</span>
                                                        Subtotal: {{ $product->price * $product->quantity }} MMK
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                $total_amount = $total_amount + $product->price * $product->quantity;
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
                                        <h4>Delivery Cost ({{$deli_address->city->city}})</h4>
                                        <div class="ml-auto font-weight-bold"> + {{ $deli_address->city->fee }} MMK </div>
                                    </div>

                                    <div class="d-flex">
                                        <h4>Coupon Discount</h4>
                                        <div class="ml-auto font-weight-bold"> - {{ Session::get('cupon_amount') ?? 0 }}
                                            MMK </div>
                                    </div>
                                   

                                    <div class="d-flex">
                                        <h4>Tax</h4>
                                        <div class="ml-auto font-weight-bold"> Free </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex gr-total">
                                        <h5>Grand Total</h5>
                                        <div class="ml-auto h5"> @php
                                            $grand_total = $total_amount + $deli_address->city->fee - session()->get('cupon_amount');
                                            echo $grand_total . ' MMK';
                                        @endphp </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>


                            <input type="hidden" name="grand_total" value="{{$grand_total}}">
                            <input type="hidden" name="delivery_charge" value="{{$deli_address->city->fee}}">




                            <div class="col-12 d-flex shopping-box"> <button class="ml-auto btn hvr-hover placeOrder">Place
                                    Order</button> </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
    <!-- End Cart -->
@endsection


@section('foot')


    <script>
        $(document).ready(function() {
            $('.placeOrder').click(function() {

                if ($('#debit').prop("checked") || $('#paypal').prop("checked")) {

                } else {

                    alert('Please Choose Payment Method!!!!');
                    return false;
                }

            })
        });
    </script>

@endsection
