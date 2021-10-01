@extends('frontend.layouts.master')

@section('content')

    <div class="wishlist-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="btn btn-outline-success mb-3"><i class="fa fa-heart" aria-hidden="true"></i> <strong>Your
                        WishList</strong> </h1>

                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price </th>
                                    <th>Add Item</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>


                            @if ($products_count > 0)

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid"
                                                    src="{{ asset('storage/products/' . unserialize($product->product_image)[0]) }}"
                                                    alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{ $product->product_name }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>{{ $product->product_price }} MMK</p>
                                        </td>
                                        <td class="add-pr">
                                            <a class="btn hvr-hover"
                                                href="{{ route('products.detail', $product->product_id) }}">Go to Product
                                                Detail</a>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="{{route('products.deleteFromWishlist', $product->id)}}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                            @else

                            <tbody>
                                <tr class="text-center mt-2">
                                    <td colspan="5">
                                        <h1 class="text-uppercase">No Products in Your WishList!!</h1>
                                    </td>

                                </tr>
                            </tbody>

                            @endif

                          
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
