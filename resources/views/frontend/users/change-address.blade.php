@extends('frontend.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <h3 class="text-bold text-cus text-center">
                            <i class="fas fa-lock"></i> Change Your Address Here
                        </h3>

                        <form action="{{route('update.address')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                    name="address" rows="2">{{$address->address ?? ''}}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <x-input name="township" type="text" :value="$address->township ?? '' " />

                            <div class="my-4">
                                <label for="city" class="form-label">City</label>
                                <select class="custom-select cities" id="city" name="city">
                                    <option selected disabled>Choose Your City</option>
                                    @foreach ($cities as $city)
                                        <option @if ($address->city_id == $city->id)
                                            selected
                                        @endif value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <button class="btn btn-primary float-right">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                Update
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('foot')

<script>
    $(document).ready(function() {
    $('.cities').select2();
});
</script>
    
@endsection