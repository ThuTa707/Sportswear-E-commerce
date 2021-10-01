@extends('frontend.layouts.master')

@section('content')

    <div class="shop-detail-box-main">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">

                                @foreach (unserialize($product->image) as $key => $image)
                                    <div class="carousel-item @if ($key == 0) active @endif "> <img class=" d-block w-100"
                                            src="{{ asset('storage/products/' . $image) }}" alt="First slide"> </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <ol class="carousel-indicators">
                                @foreach (unserialize($product->image) as $key => $image)
                                    <li data-target="#carousel-example-1" data-slide-to="{{ $key }}"
                                        class="@if ($key == 0) active @endif">
                                        <img class="d-block w-100 img-fluid"
                                            src="{{ asset('storage/products/' . $image) }}" alt="" />
                                    </li>
                                @endforeach

                            </ol>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <form action="{{ route('products.addToCart') }}" method="POST">
                            @csrf

                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" id="price" />
                            <input type="hidden" name="product_code" value="{{ $product->code }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="image" value="{{ unserialize($product->image)[0] }}">



                            <div class="single-product-details">
                                <h2>{{ $product->name }}
                                </h2>

                                <h5 id="getPrice">{{ $product->price }} MMK</h5>
                                <p class="available-stock mb-1"><span> {{ $product_stock_total }} Available / <a
                                            href="#">{{ $product->sold_stock }} SOLD </a></span>
                                </p>

                                {{-- For Checked Star --}}
                                @for ($i = 1; $i <= $average_rating; $i++)
                                    <i class="fas fa-star checked" aria-hidden="true"></i>
                                @endfor

                                {{-- For Unchecked Star --}}
                                @for ($j = $average_rating + 1; $j <= 5; $j++)
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                @endfor


                                <span> @if ($product_rating_count > 0) {{ $product_rating_count }} Rating(s) @endif </span>

                                <h4 class="mt-3">Short Description:</h4>
                                <p>{{ $product->description }}</p>
                                <ul>
                                    <li>
                                        <div class="form-group size-st">
                                            <label class="size-label">Size</label>
                                            <select name="size" id="selectSize" class="selectpicker form-control show-tick"
                                                required>
                                                <option value="0">Size</option>
                                                @foreach ($product->attributes as $key => $attribute)

                                                    @if ($attribute->stock > $attribute->sold_stock)
                                                        <option value="{{ $attribute->id }}">{{ $attribute->size }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $attribute->id }}" disabled>
                                                            {{ $attribute->size }}
                                                            (Out Of Stock)</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Quantity</label>
                                            <input name="quantity" class="form-control" value="0" min="0" max="20"
                                                type="number" required>
                                        </div>
                                    </li>
                                </ul>

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <a class="btn hvr-hover text-white mr-2" data-fancybox-close=""
                                            href="{{ route('home') }}">Back Home</a>

                                        <button type="submit" class="btn hvr-hover text-white p-2 mr-2"
                                            data-fancybox-close=""> <strong>Add to cart</strong> </button>


                                        <a class="btn hvr-hover text-white mr-2"
                                            href="{{ route('products.reviews.index', $product->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            Check Product Review
                                        </a>





                                    </div>
                                </div>

                        </form>

                        <div>
                            <div>

                                {{-- Button 1 --}}
                                <a class="btn btn-success text-white mr-2" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    Rate Product
                                </a>

                                <a class="btn btn-primary"
                                    href="{{ route('products.reviews.create', $product->id) }}">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                    Add Product Review
                                </a>

                                <!-- Modal 1 -->
                                <form action="{{ route('products.rating') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        {{ $product->name }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            <input type="radio" value="1" name="product_rating" checked
                                                                id="rating1">
                                                            <label for="rating1" class="fa fa-star"></label>
                                                            <input type="radio" value="2" name="product_rating"
                                                                id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>
                                                            <input type="radio" value="3" name="product_rating"
                                                                id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>
                                                            <input type="radio" value="4" name="product_rating"
                                                                id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>
                                                            <input type="radio" value="5" name="product_rating"
                                                                id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>



                            </div>
                            {{-- <div class="share-bar">
                                <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                            </div> --}}

                        </div>




                    </div>


                </div>

            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">

                        @foreach ($featured_products as $feature)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{ asset('storage/products/' . unserialize($feature->image)[0]) }}"
                                            class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                            class="fas fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <a class="cart" href="#">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4>Lorem ipsum dolor sit amet</h4>
                                        <h5> $9.79</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

@section('foot')

    <script>
        $(document).ready(function() {

            $('#selectSize').change(function() {
                var size = $('#selectSize').val();

                $.ajax({
                    type: "get",
                    url: "/products/getPrice", // D lo style yay ya forward slide
                    data: {
                        'size': size
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 'success') {
                            $('#getPrice').text(response.data + "MMK");

                            $('#price').val(response.data);
                            console.log(response.data);
                        } else {

                            $('#getPrice').text(response.message);
                            console.log(response.status);
                        }


                    }
                });

            })

        });
    </script>

@endsection
