@extends('backend.layouts.master')

@section('title', 'Edit Product')

@section('content')


    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-product-hunt" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1>Edit Product</h1>
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
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="clist.html">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Product </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PATCH')

                            <x-input name="name" type="text" :value="$product->name" />
                            <x-input name="code" type="text" :value="$product->code" />

                            <div class="form-group">
                                <label>Product Category</label>
                                <select class="form-select form-control form-select-sm" aria-label=".form-select-sm example"
                                    name="category">
                                    @foreach ($categories as $category)
                                        <option @if ($product->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <x-input name="price" type="number" :value="$product->price" />
                            <x-input name="description" type="text" :value="$product->description" />


                            <div class="form-group">
                                <label>Picture upload</label>
                                <input type="file" name="image[]" multiple>
                                {{-- <input type="hidden" name="old_picture"> --}}
                                @error('image')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror


                                @foreach (unserialize($product->image) as $image)
                                <img src="{{ asset('storage/products/' . $image) }}" alt=""
                                    style="width: 80px; height: 80px; margin-top:8px">
                                    @endforeach
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
