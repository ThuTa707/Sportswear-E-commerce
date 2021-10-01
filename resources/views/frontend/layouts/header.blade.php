    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">

                                @guest
                                    <li>
                                        <i class="fab fa-opencart"></i> 50% - 80% off for first time customer
                                    </li>
                                @endguest
                                <li>
                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: Dis-001
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> 1000 MMK Promo code: Dis-002
                                </li>
                                <li>
                                    <i class="fab fa-opencart"></i> Off 10%! Shop Now
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    {{-- <div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                            <option>¥ JPY</option>
                            <option>$ USD</option>
                            <option>€ EUR</option>
                        </select>
                    </div> --}}
                    <div class="right-phone-box">
                        <p>Call US :- <a href="#"> +959 776027875</a></p>
                    </div>
                    <div class="our-link">
                        <ul>


                            {{-- Add To Cart Noti by laravel php --}}
                            <li>
                                <a href="{{ route('products.cart') }}" class="align-middle"> <i
                                        class="fa fa-shopping-cart align-middle" aria-hidden="true"></i> Cart
                                </a>

                                @if (Auth::check())
                                    @php
                                        $cart_products_count = App\Cart::where('user_email', Auth::user()->email)
                                            ->get()
                                            ->count();
                                    @endphp

                                    @if ($cart_products_count >= 1)
                                        <span
                                            class="badge badge-danger align-middle">{{ $cart_products_count }}</span>
                                    @endif
                                @endif

                            </li>



                            @guest
                                <li><a href="{{ route('login') }}"> <i class="fa fa-sign-in" aria-hidden="true"></i>
                                        Login</a></li>
                                <li><a href="{{ route('register') }}"> <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        Register</a></li>

                            @else


                                {{-- WishList Noti By js + Laravel php --}}
                                <li><a href="{{ route('products.wishlist') }}" class="align-middle"> <i
                                            class="fa fa-heart" aria-hidden="true"></i>
                                        WishList</a>

                                    {{-- For Count Noti
                                    When user add product to wishlist, we use js
                                    When user go to another page, we use php below (or) we can use js by calling this js func again but it disappear awhile when page refresh --}}

                                    @if (Auth::check())
                                        @php
                                            $wish_products_count = App\WishList::where('user_id', Auth::id())
                                                ->get()
                                                ->count();
                                        @endphp
                                        <span
                                            class="badge badge-danger align-middle wishListCount">{{ $wish_products_count ? $wish_products_count : '' }}</span>
                                    @endif

                                </li>




                                <li><a href="{{ route('user') }}"> <i class="fa fa-user" aria-hidden="true"></i>
                                        {{ Auth::user()->name }}</a></li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                  document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </li>
                            @endguest

                            {{-- <li><a href="#">Our location</a></li>
                            <li><a href="#">Contact Us</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="{{ asset('frontend/images/kclogo.jpg') }}"
                            class="logo" alt="" style="width: 150px; height: 80px"></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" @if (Auth::check()) href="{{ route('home') }}" @else href="{{ route('home.intro') }}" @endif>Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/about')}}">About Us</a></li>
                        {{-- <li class="dropdown megamenu-fw">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Product</a>
                            <ul class="dropdown-menu megamenu-content" role="menu">
                                <li>
                                    <div class="row">
                                        <div class="col-menu col-md-3">
                                            <h6 class="title">Top</h6>
                                            <div class="content">
                                                <ul class="menu-col">
                                                    <li><a href="shop.html">Jackets</a></li>
                                                    <li><a href="shop.html">Shirts</a></li>
                                                    <li><a href="shop.html">Sweaters & Cardigans</a></li>
                                                    <li><a href="shop.html">T-shirts</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end col-3 -->
                                        <div class="col-menu col-md-3">
                                            <h6 class="title">Bottom</h6>
                                            <div class="content">
                                                <ul class="menu-col">
                                                    <li><a href="shop.html">Swimwear</a></li>
                                                    <li><a href="shop.html">Skirts</a></li>
                                                    <li><a href="shop.html">Jeans</a></li>
                                                    <li><a href="shop.html">Trousers</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end col-3 -->
                                        <div class="col-menu col-md-3">
                                            <h6 class="title">Clothing</h6>
                                            <div class="content">
                                                <ul class="menu-col">
                                                    <li><a href="shop.html">Top Wear</a></li>
                                                    <li><a href="shop.html">Party wear</a></li>
                                                    <li><a href="shop.html">Bottom Wear</a></li>
                                                    <li><a href="shop.html">Indian Wear</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-menu col-md-3">
                                            <h6 class="title">Accessories</h6>
                                            <div class="content">
                                                <ul class="menu-col">
                                                    <li><a href="shop.html">Bags</a></li>
                                                    <li><a href="shop.html">Sunglasses</a></li>
                                                    <li><a href="shop.html">Fragrances</a></li>
                                                    <li><a href="shop.html">Wallets</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end col-3 -->
                                    </div>
                                    <!-- end row -->
                                </li>
                            </ul>
                        </li> --}}
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Shop</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('products.cart') }}">Cart</a></li>
                                <li><a href="{{ route('user') }}">My Account</a></li>
                                <li><a href="{{ route('products.wishlist') }}">Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/service')}}">Our Service</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/contact')}}">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                {{-- <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#">
						<i class="fa fa-shopping-bag"></i>
                            <span class="badge">3</span>
					</a></li>
                    </ul>
                </div> --}}
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><img
                                    src="{{ asset('frontend/images/img-pro-01.jpg') }}" class="cart-thumb"
                                    alt="" /></a>
                            <h6><a href="#">Delica omtantur </a></h6>
                            <p>1x - <span class="price">$80.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img
                                    src="{{ asset('frontend/images/img-pro-02.jpg') }}" class="cart-thumb"
                                    alt="" /></a>
                            <h6><a href="#">Omnes ocurreret</a></h6>
                            <p>1x - <span class="price">$60.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img
                                    src="{{ asset('frontend/images/img-pro-03.jpg') }}" class="cart-thumb"
                                    alt="" /></a>
                            <h6><a href="#">Agam facilisis</a></h6>
                            <p>1x - <span class="price">$40.00</span></p>
                        </li>
                        <li class="total">
                            <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: $180.00</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
