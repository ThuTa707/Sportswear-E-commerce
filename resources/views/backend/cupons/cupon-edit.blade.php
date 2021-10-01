@extends('backend.layouts.master')

@section('title', 'Add Product')

@section('content')


    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tags" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1>Edit Cupon</h1>
            <small>Cupon Management</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="clist.html">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Cupon </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" action="{{ route('cupons.update', $cupon->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PATCH')

                            <x-input name="code" type="text" :value="$cupon->cupon_code" />
                            <x-input name="amount" type="number" :value="$cupon->amount" />

                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-select form-control form-select-sm" aria-label=".form-select-sm example"
                                    name="type">
                                    <option @if ($cupon->amount_type == 1) selected @endif value="1">Percentage</option>
                                    <option @if ($cupon->amount_type == 2) selected @endif value="2">Fixed Amount</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datepicker" class="form-label">Expire Date</label>
                                <input type="text" name="expire_date" class="form-control" id="datepicker" value="{{$cupon->expire_date}}">
                            </div>

                            <div class="reset-button">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
