@extends('backend.layouts.master')

@section('title', 'Order Detail')

@section('content')

    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tags" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1>Orders</h1>
            <small>Order Detail
            </small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-6">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Order Detail</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <tbody>

                                    <tr>
                                        <td>Order No</td>
                                        <td>{{ $order->id }}</td>
                                    </tr>

                                    <tr>
                                        <td>Order Date</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>



                                    <tr>
                                        <td>Order Total</td>
                                        <td>{{ $order->grand_total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cupon Code</td>
                                        <td>{{ $order->cupon_code ?? 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cupon Amount</td>
                                        <td>{{ $order->cupon_amount }}</td>
                                    </tr>

                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{{ $order->payment_method }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Billing Address</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <tbody>

                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Customer Phone</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>



                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $user->address->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Township</td>
                                        <td>{{ $user->address->township }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4> Customer Detail</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <tbody>

                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>



                                    <tr>
                                        <td>Customer Email</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4> Order Status</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST">
                            @csrf
                            <div class="table-responsive">

                                <tr>
                                    <td>

                                        <div class="col-md-8">
                                            <select class="form-control" aria-label="Default select example"
                                                name="status">
                                                <option value="New" @if ($order->order_status == 'New') selected @endif>New</option>
                                                <option value="Pending" @if ($order->order_status == 'Pending') selected @endif>Pending</option>
                                                <option value="In Process" @if ($order->order_status == 'In Process') selected @endif>In Process</option>
                                                <option value="Shipped" @if ($order->order_status == 'Shipped') selected @endif>Shipped</option>
                                                <option value="Delivered" @if ($order->order_status == 'Delivered') selected @endif>Delivered</option>
                                                <option value="Cancel" @if ($order->order_status == 'Cancel') selected @endif>Cancel</option>
                                                <option value="Paid" @if ($order->status == 'Paid') selected @endif>Paid</option>
                                            </select>
                                        </div>




                                        <button class="btn btn-success">Update
                                            Status</button>

                                    </td>
                                </tr>




                            </div>

                        </form>
                    </div>
                </div>

                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>Shipping Address</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <tbody>

                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{ $order->shipping_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Customer Phone</td>
                                        <td>{{ $order->shipping_phone }}</td>
                                    </tr>



                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $order->shipping_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Township</td>
                                        <td>{{ $order->shipping_township }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <table id="table" class="table table-bordered table-striped table-hover text-center">
                <thead>
                    <tr class="info">
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product Quantity</th>
                        <th>Product Price Per One</th>
                        <th>Product Size</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->orderProducts as $order)
                        <tr>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->product_code }}</td>
                            <td>{{$order->product_quantity}}</td>
                            <td>{{ $order->product_price }}</td>
                            <td>{{ $order->product_size }}</td>

                        </tr>
                    @endforeach

                </tbody>


            </table>




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
