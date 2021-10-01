@extends('backend.layouts.master')

@section('title', 'Edit Banner')

@section('content')


<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-image" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Edit Banner</h1>
        <small>Banner Management</small>
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
                            <i class="fa fa-image" aria-hidden="true"></i> Edit Banner </a>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="col-sm-6" action="{{route('banners.update', $banner->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')

                        <x-input name="title" type="text" :value="$banner->title" />
                        <x-input name="content" type="text" :value="$banner->content" />
                        <x-input name="text_style" type="text" :value="$banner->text_style" />
                        <x-input name="link" type="text" :value="$banner->link" />
                        <x-input name="sort_order" type="number" :value="$banner->sort_order" />


                        <div class="form-group">
                            <label>Picture upload</label>
                            <input type="file" name="image">

                            @error('image')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror

                            <img src="{{asset('storage/banners/'.$banner->image)}}" alt="" style="width: 80px; height: 50px; margin-top:8px">
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
