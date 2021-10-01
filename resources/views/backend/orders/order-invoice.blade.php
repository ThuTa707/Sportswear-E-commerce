<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Generate</title>

    <link rel="stylesheet" href=" {{ asset('frontend/css/bootstrap.min.css') }}">

    <style>
        body {
            background-color: #000
        }

        .padding {
            padding: 2rem !important
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium'
        }

        .text-dark {
            color: #3d405c !important
        }

    </style>

</head>

<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="index.html" data-abc="true">kcsportscollection.com</a>
                <div class="float-right">
                    <h3 class="mb-0">Invoice No-{{ $order->id }}</h3>
                    {{ date('d-M-Y') }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">Billing Address:</h5>
                        <h3 class="text-dark mb-1">{{ $user->name }}</h3>
                        <div>{{ $address->address }}</div>
                        <div>{{ $address->township }}</div>
                        <div>{{ $address->city->city }}</div>
                        <div>Email: {{ $user->email }}</div>
                        <div>Phone: {{ $user->phone }}</div>
                    </div>
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">Delivered Address:</h5>
                        <h3 class="text-dark mb-1">{{ $order->shipping_name }}</h3>
                        <div>{{ $order->shipping_address }}</div>
                        <div>{{ $order->shipping_township }}</div>
                        <div>{{ $order->shipping_city }}</div>
                        <div>Email: {{ $order->email }}</div>
                        <div>Phone: {{ $order->shipping_phone }} </div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Code</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $total_amount = 0;
                            @endphp
                            @foreach ($order->orderProducts as $or)
                                <tr>
                                    <td class="center">{{ $or->product_name }}</td>
                                    <td class="left strong">{{ $or->product_code }}</td>
                                    <td class="left">{{ $or->product_size }}</td>
                                    <td class="right">{{ $or->product_price }}</td>
                                    <td class="center">{{ $or->product_quantity }}</td>
                                    <td class="right">{{ $or->product_price * $or->product_quantity }}
                                    </td>
                                </tr>

                                @php
                                    $total_amount = $total_amount + $or->product_price * $or->product_quantity;
                                @endphp

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-6 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Subtotal</strong>
                                    </td>
                                    <td class="right">{{ $total_amount }} MMK</td>
                                </tr>

                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Delivery Charge({{$order->shipping_city}})</strong>
                                    </td>
                                    <td class="right">+ {{$order->delivery_charge}} MMK</td>
                                </tr>

                                @if ($order->cupon_amount)
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Discount</strong>
                                        </td>
                                        <td class="right">- {{ $order->cupon_amount }} MMK</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">VAT</strong>
                                    </td>
                                    <td class="right">Free</td>
                                </tr>

                         
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Grand Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark">{{$order->grand_total}} MMK</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">kcsportscollection.com, Kyaik Ka San Pagoda Road, Thingangyun, Yangon</p>
            </div>
        </div>
    </div>
</body>

</html>
