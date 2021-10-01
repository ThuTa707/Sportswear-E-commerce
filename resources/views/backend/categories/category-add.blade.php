@extends('backend.layouts.master')

@section('title', 'Add Product')

@section('content')


<section class="content-header">
    <div class="header-icon">
       <i class="fa fa-list" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Add Category</h1>
        <small>Category Management</small>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- Form controls -->
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    {{-- <div class="btn-group" id="buttonlist">
                        <a class="btn btn-add">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category </a>
                    </div> --}}
                </div>
                <div class="panel-body">
                    <form class="col-sm-6" action="{{route('categories.store')}}" method="POST" novalidate>
                        @csrf

                        <x-input name="name" type="text" />


                        <div class="reset-button">
                            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                            <a href="{{route('categories.index')}}" class="btn btn-warning">Cancel</a>
                            <button class="btn btn-success">Submit</button>
                      
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
