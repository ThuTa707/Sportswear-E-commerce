@extends('frontend.layouts.master')

@section('content')
    <div class="container my-5">
        <form action="" method="POST">
            @csrf
            <div class="row">




                <div class="col-md-6">

                    <div class="card shadow border-0">

                        <div class="card-body">

                            <h3 class="text-bold text-cus text-center">
                                <i class="fas fa-file-invoice"></i> Billing Info
                            </h3>
                            <x-input get-class="address" name="address" type="text"
                                :value="$address->address ?? '' " />

                            <x-input get-class="township" name="township" type="text"
                                :value="$address->township ?? '' " />

                            <div class="my-4">
                                <label for="city" class="form-label">City</label>
                                <select class="custom-select cities" id="city" name="city">
                                    <option value="">Choose Country</option>
                                    @foreach ($cities as $city)
                                        <option @if (!empty($address->city_id))
                                            @if ($address->city_id == $city->id)
                                                selected
                                            @endif
                                            @endif value="{{ $city->id }}">{{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-input get-class="name" name="name" type="text"
                                :value="Auth::user()->name ?? '' " />
                            <x-input get-class="phone" name="phone" type="text"
                                :value="Auth::user()->phone ?? '' " />


                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="checkInfo">
                                <label class="form-check-label" for="checkInfo">Shipping address is the same as my billing
                                    address</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow border-0">

                        <div class="card-body">

                            <h3 class="text-bold text-cus text-center">
                                <i class="fas fa-shipping-fast"></i> Shipping Info
                            </h3>
                            <x-input get-class="shipping_address" name="shipping_address" type="text" :value="$address->address ?? '' "  />

                            <x-input get-class="shipping_township" name="shipping_township" type="text" :value="$address->township ?? '' " />

                            <div class="my-4">
                                <label for="city" class="form-label">Shipping_city</label>
                                <select class="custom-select cities2" id="shipping_cities" name="shipping_cities">
                                    <option value="">Choose Country</option>
                                    @foreach ($cities as $city)
                                        <option @if (!empty($address->city_id))
                                            @if ($address->city_id == $city->id)
                                                selected
                                            @endif
                                            @endif value="{{ $city->id }}">{{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-input get-class="shipping_name" name="shipping_name" type="text" :value="$address->user->name ?? '' " />
                            <x-input get-class="shipping_phone" name="shipping_phone" type="text" :value="$address->user->phone ?? '' " />

                            <button class="btn btn-primary float-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Review Order
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection


@section('foot')

    <script>
        $(document).ready(function() {
            $('.cities').select2();

            $('.cities2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {


            $('#checkInfo').click(function() {
                if (this.checked) {
                    $('.shipping_address').val($('.address').val());
                    $('.shipping_township').val($('.township').val());

                    // $('#shipping_cities').val($('#city').val())

                    $('.shipping_name').val($('.name').val());
                    $('.shipping_phone').val($('.phone').val());

                } else {
                    $('.shipping_address').val('');
                    $('.shipping_township').val('');

                    // $('#shipping_cities').val('')

                    $('.shipping_name').val('');
                    $('.shipping_phone').val('');

                }
            })
        });
    </script>

@endsection
