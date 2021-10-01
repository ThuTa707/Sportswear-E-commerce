@extends('backend.layouts.master')

@section('title', 'Edit Categoru')

@section('content')


<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-list" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Edit Category</h1>
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
                    <div class="btn-group" id="buttonlist">
                        <a class="btn btn-add " href="clist.html">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Category </a>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="col-sm-6" action="{{route('categories.update', $category->id)}}" method="POST" novalidate>
                        @csrf
                        @method('PATCH')

                        <x-input name="name" type="text" :value="$category->name" />
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

