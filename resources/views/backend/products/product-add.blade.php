@extends('backend.layouts.master')

@section('title', 'Add Product')

@section('content')


<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-product-hunt" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Add Product</h1>
        <small>Products Management</small>
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
                        <a class="btn btn-add " href="clist.html">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product </a>
                    </div> --}}
                </div>
                <div class="panel-body">
                    <form class="col-sm-6" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <x-input name="name" type="text" />
                        <x-input name="code" type="text"/>

                        <div class="form-group">
                            <label>Product Category</label>
                            <select class="form-select form-control form-select-sm" aria-label=".form-select-sm example" name="category">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>  
                                @endforeach
                               
                              </select>
                        </div>

                         <x-input name="price" type="number" />
                         <x-input name="description" type="text"/>


                        <div class="form-group">
                            <label>Picture upload</label>
                            <input type="file" name="images[]" multiple>
                            @error('image')
                            <span class="invalid-feedback text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                        </div>
                        <div class="reset-button">
                            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                            <a href="{{route('products.index')}}" class="btn btn-warning">Cancel</a>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
