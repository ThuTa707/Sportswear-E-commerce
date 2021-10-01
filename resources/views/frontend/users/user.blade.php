@extends('frontend.layouts.master')

@section('content')


<div class="my-account-box-main">
    <div class="container">
        <div class="my-account-page">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{route('ordersList')}}"> <i class="fa fa-gift"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Your Orders</h4>
                                <p>Track, return, or buy things again</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{route('password')}}"><i class="fa fa-lock"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Login &amp; security</h4>
                                <p>Change Account Password</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{route('address')}}"> <i class="fa fa-location-arrow"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Your Addresses</h4>
                                <p>Edit addresses for orders and gifts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="bottom-box">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Gold &amp; Diamond Jewellery</h4>
                                    <ul>
                                        <li> <a href="#">Apps and more</a> </li>
                                        <li> <a href="#">Content and devices</a> </li>
                                        <li> <a href="#">Music settings</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Handloom &amp; Handicraft Store</h4>
                                    <ul>
                                        <li> <a href="#">Advertising preferences </a> </li>
                                        <li> <a href="#">Communication preferences</a> </li>
                                        <li> <a href="#">SMS alert preferences</a> </li>
                                        <li> <a href="#">Message center</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>The Designer Boutique</h4>
                                    <ul>
                                        <li> <a href="#">Amazon Pay</a> </li>
                                        <li> <a href="#">Bank accounts for refunds</a> </li>
                                        <li> <a href="#">Coupons</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Gift Boxes, Gift Tags, Greeting Cards</h4>
                                    <ul>
                                        <li> <a href="#">Leave delivery feedback</a> </li>
                                        <li> <a href="#">Lists</a> </li>
                                        <li> <a href="#">Photo ID proofs</a> </li>
                                        <li> <a href="#">Profile</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Other accounts</h4>
                                    <ul>
                                        <li> <a href="#">Amazon Business registration</a> </li>
                                        <li> <a href="#">Seller account</a> </li>
                                        <li> <a href="#">Amazon Web Services</a> </li>
                                        <li> <a href="#">Login with Amazon</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Shopping programs and rentals</h4>
                                    <ul>
                                        <li> <a href="#">Subscribe &amp; Save</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>


@endsection