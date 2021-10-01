@extends('frontend.layouts.master')

@section('content')
    <div class="container text-center my-5">
        <h1 class="mb-2">Thanks A Lot For Purchasing With Us!!!!</h1>
        <div class="row">
            <div class="col-md-6">


                <div class="card">

                    <div class="card-body bg-success">
                        <h1 class="text-white text-uppercase">Your order has been placed.</h3>
                            <h3 class="text-white"> Your order number is {{ Session::get('order_id') }} and your total
                                payment is
                                {{ Session::get('total') }} MMK.</h3>
                            <h3 class="text-white">Please make the online payment with stripe!!!</h3>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                Stripe Payment Here


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
