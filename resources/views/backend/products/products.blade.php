@extends('backend.layouts.master')

@section('title', 'Product List')

@section('content')

<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-product-hunt" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Product</h1>
        <small>Product List</small>
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
                            <h4>Product List</h4>
                        </a>
                    </div>
                </div>
            
                <div class="panel-body">
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{route('products.create')}}"> <i class="fa fa-plus"></i> Add Product
                            </a>
                        </div>
                        
                        
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    {{-- <th>Code</th> --}}
                                    {{-- <th>Category</th> --}}
                                    <th>Description
                                       
                                    </th>
                                    <th>Price</th>
                                    <th style="width: 100px">Image</th>
                                    {{-- <th>User</th> --}}
                                    <th style="width: 100px">Action</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>

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
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/datatable/',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }


            ]
        });

    });


// Laravel Datatable nk twl use ml so yin.......d style yayy ko yayy ya ml jquery

    $(document).on('click', '.del', function() {

        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

           
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                
                $('#delForm'+id).submit();

            }
        })

    });


    $(document).on('click', '.pstatusUnactive', function() {

var id = $(this).data('id');

Swal.fire({
    title: 'Are you sure to inactive?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Cofirm',
    reverseButtons: true
}).then((result) => {
    if (result.isConfirmed) {

        Swal.fire(
            'Completed!!!',
            'The status is inactive now.',
            'success'
        )

        setTimeout(function() {
            $('#statusForm' + id).submit();
        })


    }
})

});


$(document).on('click', '.pstatusActive', function() {

var id = $(this).data('id');

Swal.fire({
    title: 'Are you sure to active?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Cofirm',
    reverseButtons: true
}).then((result) => {
    if (result.isConfirmed) {

        Swal.fire(
            'Completed!!!',
            'The status is active now.',
            'success'
        )

        setTimeout(function() {
            $('#statusForm' + id).submit();
        })


    }
})

});



</script>

@endsection
