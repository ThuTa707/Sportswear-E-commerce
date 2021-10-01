@extends('frontend.layouts.master')

@section('content')


    <div class="container my-5">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-cus text-white">
                        {{ $product->name }}
                    </div>
                    <div class="card-body">
                        @if ($purchase_verified > 0)
                            <form action="{{ route('products.reviews.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Write Review</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"
                                        required></textarea>
                                </div>

                                <button class="btn btn-primary float-right">Submit</button>
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-warning float-right mr-2">Back</a>
                            </form>

                        @else

                            <div class="alert alert-danger" role="alert">
                                <h3>
                                    <strong>
                                        For the trustwothiness for the review, <br> <br>
                                        Customers who bought the product are only permitted to review!
                                        <br>
                                        Thanks a lot for your interest!!!
                                    </strong>

                                </h3>

                            </div>


                        @endif


                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
