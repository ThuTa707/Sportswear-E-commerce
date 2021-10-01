@extends('frontend.layouts.master')

@section('content')


    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        {{ $productReview->product->name }}
                    </div>
                    <div class="card-body">

                            <form action="{{ route('reviews.update', $productReview->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Edit Review</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review">{{$productReview->product_review}}</textarea>
                                </div>

                                <button class="btn btn-primary float-right">Edit</button>
                            </form>


                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
