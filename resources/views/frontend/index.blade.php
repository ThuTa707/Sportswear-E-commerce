@extends('frontend.layouts.master')

@section('content')



   <!-- Start Slider -->
   <div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        @foreach ($banners as $banner)
            <li class="{{ $banner->text_style }}">
                <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>{!! $banner->title !!}</strong></h1>
                            <p class="m-b-40">{!! $banner->content !!}</p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">

        <div class="container">
            <form action="{{ route('products.filter') }}" method="get" class="filterForm">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                        <div class="product-categori">
                            <div class="search-product">
                                <input class="form-control"
                                    placeholder="{{ request()->searchProduct ?? 'Search Product Here' }}" type="text"
                                    name="searchProduct">
                                <button type="submit"> <i class="fa fa-search"></i> </button>

                            </div>



                            <div class="filter-sidebar-left">
                                <div class="title-left">
                                    <h3>Categories</h3>
                                </div>
                                <div class="list-group list-group-collapse list-group-sm list-group-tree"
                                    id="list-group-men" data-children=".sub-men">



                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category" id="category" value=""
                                            checked>
                                        <label class="form-check-label" for="category">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($categories as $cat)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="category"
                                                value="{{ $cat->id }}" @if (request()->category == $cat->id) checked @endif>
                                            <label class="form-check-label" for="category">
                                                {{ $cat->name }}
                                            </label>
                                        </div>
                                    @endforeach



                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                        <div class="right-product-box">
                            <div class="product-item-filter row">
                                <div class="col-12 col-sm-8 text-center text-sm-left">
                                    <div class="toolbar-sorter-right">
                                        <span>Sort by </span>

                                        <select id="sorting" name="sorting" class="selectpicker show-tick form-control"
                                            data-placeholder="$ USD">
                                            <option data-display="Select" value="">Nothing</option>
                                            <option value="1" @if (request()->sorting == 1) selected @endif>Best Selling</option>
                                            <option value="2" @if (request()->sorting == 2) selected @endif>High Price → Low Price</option>
                                            <option value="3" @if (request()->sorting == 3) selected @endif>Low Price → High Price</option>
                                        </select>

            </form>
        </div>

        <p>Showing all 4 results</p>
    </div>

    <div class="col-12 col-sm-4 text-center text-sm-right">
        <ul class="nav nav-tabs ml-auto">
            <li>
                <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
            </li>
            {{-- <li>
                <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
            </li> --}}
        </ul>
    </div>
    </div>

    <div class="row product-categorie-box">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">Sale</p>
                                    </div>
                                    <img src="{{ asset('storage/products/' . unserialize($product->image)[0]) }}"
                                        class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="{{ route('products.detail', $product->id) }}"
                                                    data-toggle="tooltip" data-placement="right" title="View"><i
                                                        class="fas fa-eye"></i></a></li>

                                            <li><a href="#" class="wishList" data-id="{{ $product->id }}"
                                                    data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i
                                                        class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                        <a class="cart" href="{{ route('products.detail', $product->id) }}">See
                                            Detail</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>{{ $product->name }}</h4>
                                    <h5 class="mb-2"> {{ $product->price }} MMK</h5>

                                </div>
                            </div>
                        </div>

                    @endforeach


                </div>
                {{ $products->appends(Request::all())->links() }}
            </div>



            {{-- <div role="tabpanel" class="tab-pane fade" id="list-view">
                <div class="list-view-box">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="new">New</p>
                                    </div>
                                    <img src="images/img-pro-01.jpg" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                        class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                        class="fas fa-sync-alt"></i></a>
                                            </li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                            <div class="why-text full-width">
                                <h4>Lorem ipsum dolor sit amet</h4>
                                <h5> <del>$ 60.00</del> $40.79</h5>
                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                    imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                    suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                    aliquam purus
                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                    blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis
                                    euismod ex volutpat in. Vestibulum eleifend eros ac lobortis
                                    aliquet.
                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                    quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut
                                    placerat lectus.</p>
                                <a class="btn hvr-hover" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-view-box">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">Sale</p>
                                    </div>
                                    <img src="images/img-pro-02.jpg" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                        class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                        class="fas fa-sync-alt"></i></a>
                                            </li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                            <div class="why-text full-width">
                                <h4>Lorem ipsum dolor sit amet</h4>
                                <h5> <del>$ 60.00</del> $40.79</h5>
                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                    imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                    suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                    aliquam purus
                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                    blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis
                                    euismod ex volutpat in. Vestibulum eleifend eros ac lobortis
                                    aliquet.
                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                    quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut
                                    placerat lectus.</p>
                                <a class="btn hvr-hover" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-view-box">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">Sale</p>
                                    </div>
                                    <img src="images/img-pro-03.jpg" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                        class="fas fa-eye"></i></a>
                                            </li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                        class="fas fa-sync-alt"></i></a>
                                            </li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                            <div class="why-text full-width">
                                <h4>Lorem ipsum dolor sit amet</h4>
                                <h5> <del>$ 60.00</del> $40.79</h5>
                                <p>Integer tincidunt aliquet nibh vitae dictum. In turpis sapien,
                                    imperdiet quis magna nec, iaculis ultrices ante. Integer vitae
                                    suscipit nisi. Morbi dignissim risus sit amet orci porta, eget
                                    aliquam purus
                                    sollicitudin. Cras eu metus felis. Sed arcu arcu, sagittis in
                                    blandit eu, imperdiet sit amet eros. Donec accumsan nisi purus, quis
                                    euismod ex volutpat in. Vestibulum eleifend eros ac lobortis
                                    aliquet.
                                    Suspendisse at ipsum vel lacus vehicula blandit et sollicitudin
                                    quam. Praesent vulputate semper libero pulvinar consequat. Etiam ut
                                    placerat lectus.</p>
                                <a class="btn hvr-hover" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- End Shop Page -->

     



    <!-- Start Blog  -->
    {{-- <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>latest blog</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('frontend/images/blog-img.jpg') }}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna
                                    dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis.
                                    Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i
                                            class="far fa-heart"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i
                                            class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i
                                            class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('frontend/images/blog-img-01.jpg') }}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna
                                    dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis.
                                    Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i
                                            class="far fa-heart"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i
                                            class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i
                                            class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{ asset('frontend/images/blog-img-02.jpg') }}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna
                                    dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis.
                                    Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Likes"><i
                                            class="far fa-heart"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Views"><i
                                            class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Comments"><i
                                            class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Blog  -->


    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-01.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-02.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-03.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-04.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-06.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-07.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-08.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-09.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('frontend/images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->
@endsection


@section('foot')

    <script>
        $(document).ready(function() {

            var $radios = $('input[name="category"]');
            $radios.change(function() {
                $('.filterForm').submit();
            })


            $('#sorting').change(function() {
                $('.filterForm').submit();
            })


            $('.wishList').click(function() {

                var id = $(this).data('id');

                // From Laravel Docu (Has to contain meta csrf in master layout file)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: `/products/add-to-wishlist?id=${id}`,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            console.log(response.info);
                            wishListCount();
                        } else {

                            console.log(response.info);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: response.icon,
                                title: response.info,
                            })
                        }
                    }
                });



            })


            // Main Func Below
            function wishListCount() {
                $.ajax({
                    type: "get",
                    url: "/products/wish-list-count",
                    dataType: "json",
                    success: function(response) {

                        $('.wishListCount').html(response.count);
                        console.log(response.status);
                    }
                });
            }


        });
    </script>

@endsection
