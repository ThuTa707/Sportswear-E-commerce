@extends('backend.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')

    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="header-title">
            <h1>Admin Dashobard</h1>
            <small>KC Sports Collection</small>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox1">
                    <div class="statistic-box">
                        <i class="fa fa-user-plus fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $active_users_count }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Active Client</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox2">
                    <div class="statistic-box">
                        <i class="fa fa-user-secret fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $active_admins_count }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Active Admin</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox3">
                    <div class="statistic-box">
                        <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
                        <div class="counter-number pull-right">
                            {{-- <i class="ti ti-money"></i> --}}
                            <span class="count-number">{{ $today_orders_count }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Today Orders</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $today_revenue }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Today Revenue (MMK) </h3>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $total_orders_count }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Total Order </h3>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $total_revenue }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Total Revenue (MMK) </h3>
                    </div>
                </div>
            </div>


            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">{{ $best_selling_product->sold_stock }}</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                            </span>
                        </div>
                        <h3> Best Selling Product - {{ $best_selling_product->name }} </h3>
                    </div>
                </div>
            </div>






        </div>




        <div class="row">
            <div class="col-12">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Latest Incoming 10 Orders</h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr class="info">
                                        <th>No</th>
                                        {{-- <th>Order Date/Time</th> --}}
                                        <th>Customer Email</th>
                                        <th style="width: 200px">Ordered Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th style="width: 250px">Action</th>
                                    </tr>
                                </thead>
                                @foreach ($latest_orders as $order)
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
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Customers</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Categories</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>No</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
