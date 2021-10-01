@extends('frontend.layouts.master')

@section('content')

    <div class="container text-center my-4">

        

        <h1 class="text-uppercase mb-3 text-cus"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Orders List</h1>
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Products</th>
                    <th>Payment Method</th>
                    <th>Grand Total</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>
                        @foreach ($order->orderProducts as $product)
                            <a href="">{{$product->product_name}}</a>
                            <a href="">{{$product->product_size}}</a>
                            <a href="">{{$product->product_quantity}}</a>
                            <br>
                        @endforeach
                    </td>
                    <td>{{$order->payment_method}}</td>
                    <td>{{$order->grand_total}}</td>
                    <td>{{$order->order_status}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                    <a href="{{route('orderDetail', $order->id)}}" class="btn btn-primary btn-sm">View Detail</a>
                    </td>
                </tr>
                @endforeach
                

            </tbody>
        </table>

   
    </div>
    </div>
@endsection
