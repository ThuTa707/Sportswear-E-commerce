@extends('frontend.layouts.master')

@section('content')


    <!-- Start Cart  -->
    
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="btn btn-outline-primary mb-3"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <strong>Your
                            Cart</strong> </h1>


                    <div class="table-main table-responsive">

                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th style="width: 200px">Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>

                            @php
                                $total_amount = 0;
                            @endphp


                            @if ($cart_products_count > 0)

                                {{-- Getting total amount in cart --}}

                                @foreach ($cart_products as $cart_product)
                                    <tbody>
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid"
                                                        src="{{ asset('storage/products/' . $cart_product->image) }}"
                                                        alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">
                                                    {{ $cart_product->name }}
                                                </a>
                                            </td>

                                            <td class="price-pr">
                                                <p>{{ $cart_product->price }} MMK</p>
                                            </td>
                                            <td class="size-pr">
                                                <p>{{ $cart_product->size }}</p>
                                            </td>
                                            <td class="quantity-box">

                                                <a data-id="{{ $cart_product->id }}" class="plus"> <i
                                                        class="fa fa-plus" aria-hidden="true"></i> </a>
                                                <input type="number" size="4" value="{{ $cart_product->quantity }}"
                                                    min="0" step="1"
                                                    class="c-input-text qty text quantity{{ $cart_product->id }}">
                                                <a data-id="{{ $cart_product->id }}" class="minus"> <i
                                                        class="fa fa-minus" aria-hidden="true"></i> </a>



                                            </td>
                                            <td class="total-pr">
                                                <p class="updatePrice{{ $cart_product->id }}">
                                                    {{ $cart_product->price * $cart_product->quantity }}
                                                    MMK
                                                </p>
                                            </td>
                                            <td class="remove-pr">
                                                <a href="{{ route('products.deleteFromCart', $cart_product->id) }}">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>

                                    {{-- Getting total amount in cart --}}
                                    @php
                                        $total_amount = $total_amount + $cart_product->price * $cart_product->quantity;
                                    @endphp

                                @endforeach



                            @else
                                <tbody>
                                    <tr class="text-center mt-2">
                                        <td colspan="7">
                                            <h1 class="text-uppercase">No Products in Your Cart!!</h1>
                                        </td>

                                    </tr>
                                </tbody>


                            @endif

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <form action="{{ route('apply.cupon') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code"
                                    type="text" name="cupon" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-theme">Apply Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Update Cart" type="submit">
                    </div>
                </div> --}}

                <div class="col-lg-2 col-sm-12"></div>

                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold subTotal"> {{ $total_amount ?? 0 }} MMK </div>
                        </div>
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> - {{ Session::get('cupon_amount') ?? 0 }} MMK </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5 grandTotal">
                                @php
                                    $grand_total = $total_amount - session()->get('cupon_amount');
                                    echo $grand_total . ' MMK';
                                @endphp
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{ route('checkout') }}"
                        class="ml-auto btn hvr-hover">Checkout</a>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection

@section('foot')

    <script>
        $('.plus').click(function() {

            var id = $(this).data('id');
            var quantity = $(`.quantity${id}`).val();

            var updateQuantity = parseInt(quantity) + 1;
            console.log(updateQuantity)

            $.ajax({
                type: "get",
                url: `/products/update-quantity/?id=${id}&quantity=${updateQuantity}`,
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        $(`.quantity${id}`).val(response.data['quantity']);
                        var updatePrice = response.data['quantity'] * response.data[
                            'price'] + 'MMK';
                        $(`.updatePrice${id}`).text(updatePrice);



                        // For SubTotal
                        var subTotal = $('.subTotal').text();
                        if (subTotal) {
                            var finalTotal = parseInt(subTotal) + response.data['price'] + 'MMK';
                            $('.subTotal').text(finalTotal);
                        }


                        // For GrandTotal
                        var grandTotal = $('.grandTotal').text();
                        if (grandTotal) {
                            var finalTotal = parseInt(grandTotal) + response.data['price'] + 'MMK';
                            $('.grandTotal').text(finalTotal);
                        }

                        console.log(response.status)
                    } else {
                        console.log(response.message)
                    }
                }



            });

        })


        $('.minus').click(function() {

            var id = $(this).data('id');
            var quantity = $(`.quantity${id}`).val();

            var updateQuantity = quantity;

            // Prevent - 
            if (quantity > 1) {
                var updateQuantity = quantity - 1;
            }


            $.ajax({
                type: "get",
                url: `/products/update-quantity/?id=${id}&quantity=${updateQuantity}`,
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        $(`.quantity${id}`).val(response.data['quantity']);
                        var updatePrice = response.data['quantity'] * response.data[
                            'price'] + 'MMK';
                        $(`.updatePrice${id}`).text(updatePrice);


                        // Prevent - 
                        if (quantity > 1) {

                            // For SubTotal
                            var subTotal = $('.subTotal').text();
                            if (subTotal) {
                                var finalTotal = parseInt(subTotal) - response.data['price'] + 'MMK';
                                $('.subTotal').text(finalTotal);
                            }

                            // For GrandTotal
                            var grandTotal = $('.grandTotal').text();
                            if (grandTotal) {
                                var finalTotal = parseInt(grandTotal) - response.data['price'] + 'MMK';
                                $('.grandTotal').text(finalTotal);
                            }

                        }


                        console.log(response.status)
                    } else {
                        console.log(response.message)
                    }
                }



            });

        });
    </script>

@endsection
