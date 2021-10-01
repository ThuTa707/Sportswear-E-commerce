@extends('backend.layouts.master')

@section('title', 'Add Banner')

@section('content')


<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-image" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Add Banner</h1>
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
                    {{-- <div class="btn-group" id="buttonlist">
                        <a class="btn btn-add " href="clist.html">
                            <i class="fa fa-image" aria-hidden="true"></i> Add Banner </a>
                    </div> --}}
                </div>
                <div class="panel-body">
                    <form class="col-sm-6" action="{{route('banners.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <x-input name="title" type="text" />
                        <x-input name="content" type="text" />
                        <x-input name="text_style" type="text" />
                        <x-input name="link" type="text" />
                        <x-input name="sort_order" type="number" />


                        <div class="form-group">
                            <label>Picture upload</label>
                            <input type="file" name="image">

                            @error('image')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="reset-button">
                            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                            <a href="{{route('banners.index')}}" class="btn btn-warning">Cancel</a>
                            <button class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
