@extends('frontend.layouts.master')

@section('content')
    <div class="container text-center my-5">
        <div class="col-8 offset-2">

            <h1 class="mb-2 text-uppercase">Thanks a lot for Purchasing with Us!!!!</h1>
            <div class="card">

                <div class="card-body bg-success">
                    <h4 class="text-white">Your order has been placed.</h4>
                    <h4 class="text-white">Your order number is {{ Session::get('order_id') }} and your total payment is
                        {{ Session::get('total')}} MMK</h4>
                </div>

            </div>

        </div>

    </div>
    </div>
@endsection


@php
Session::forget('order_id');
Session::forget('total');
Session::forget('cupon_amount');
@endphp
