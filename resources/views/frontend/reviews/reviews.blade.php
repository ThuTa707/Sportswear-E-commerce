@extends('frontend.layouts.master')

@section('content')


    <div class="container my-4">

        <a href="{{ route('products.detail', $product->id) }}" class="btn btn-primary btn-sm mb-3">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>  
            Back to Product
            Detail</a>
        <div class="card">
            <div class="card-header bg-cus text-white">
                {{ $product->name }} Reviews
            </div>
            <div class="card-body">

                @if ($reviews_count > 0)
                    @foreach ($reviews as $review)
                        <h3> <i class="fa fa-user" aria-hidden="true"></i> {{ $review->user->name }}</h3>

                        @if ($review->rating)
                            @php
                                
                                $rating = $review->rating->product_rating;
                                
                            @endphp

                            {{-- For Checked Star --}}
                            @for ($i = 1; $i <= $rating; $i++)
                                <i class="fas fa-star checked" aria-hidden="true"></i>
                            @endfor

                            {{-- For Unchecked Star --}}
                            @for ($j = $rating + 1; $j <= 5; $j++)
                                <i class="fas fa-star" aria-hidden="true"></i>
                            @endfor

                        @endif

                        <span> Review on {{ $review->created_at->format('d-M-Y') }}</span>

                        <p class="my-2">"{{ $review->product_review }}"</p>


                        @if ($review->user_id == Auth::id())
                            <a class="btn btn-warning btn-sm text-white" href="{{ route('reviews.edit', $review->id) }}"><i
                                    class="fa fa-edit" aria-hidden="true"></i></a>

                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                style="display:inline-block; margin-left:5px">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm del"><i class="fa fa-trash" aria-hidden="true">
                                    </i></button>
                            </form>
                        @endif


                        <hr>
                    @endforeach

                    {{ $reviews->appends(Request::all())->links() }}

                @else
                    <div class="text-center">
                        <h3>
                            No reviews at the moment. Be the first reviewer for this product!!
                        </h3>

                    </div>


                @endif

            </div>
        </div>


    </div>


@endsection
