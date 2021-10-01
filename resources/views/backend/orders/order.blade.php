@extends('backend.layouts.master')

@section('title', 'Order List')

@section('content')

    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tags" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1>Orders</h1>
            <small>Orders List</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Orders List</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{-- <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="add-customer.html"> <i class="fa fa-plus"></i> Add Product
                            </a>
                        </div>
                        
                    </div> --}}
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr class="info">
                                        <th>Order Id</th>
                                        {{-- <th>Order Date/Time</th> --}}
                                        <th>Customer Email</th>
                                        <th style="width: 200px">Ordered Product</th>
                                        <th>Ordered Amount</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        {{-- <td>

                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ $order->created_at->format('d-m-Y') }}
                                            <br>
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            {{ $order->created_at->format('H:ia') }}

                                        </td> --}}
                                        <td>{{ $order->email }}</td>
                                        <td>
                                            @foreach ($order->orderProducts as $product)
                                                <span>{{ $product->product_name }}</span>
                                                <span>{{ $product->product_size }}</span>
                                                <span>({{ $product->product_quantity }})</span>
                                                <br>
                                            @endforeach

                                        </td>
                                        <td>{{ $order->grand_total }}</td>

                                        <td>{{ $order->order_status }}</td>

                                        {{-- <td>
                                            <input data-id="{{ $cupon->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $cupon->status ? 'checked' : '' }}>

                                        </td> --}}

                                        <td>{{ $order->payment_method }}</td>
                                        <td>

                                            <a href="{{ route('admin.order.detail', $order->id) }}"
                                                class="btn btn-sm btn-success">View Detail</a>
                                            <a href="{{ route('admin.order.generate-invoice', $order->id) }}"
                                                class="btn btn-sm btn-primary">Generate Invoice</a>

                                        </td>

                                    </tr>
                                @endforeach

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection


@section('foot')



    <script>
        $(function() {

            $('.toggle-class').change(function() {

                var status = $(this).prop('checked') == true ? 1 : 0;

                var user_id = $(this).data('id');

                $.ajax({

                    type: "get",

                    dataType: "json",

                    url: '/admin/changeStatus/cupons',

                    data: {
                        'status': status,
                        'user_id': user_id
                    },

                    success: function(data) {

                        console.log(data.success)

                    }

                });

            })

        })
    </script>

@endsection
