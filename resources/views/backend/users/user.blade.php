@extends('backend.layouts.master')

@section('title', 'Customers List')

@section('content')

    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1>Customers</h1>
            <small>Customers List</small>
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
                                <h4>Customer List</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{-- <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="add-customer.html"> <i class="fa fa-plus"></i> Add Product
                            </a>
                        </div>
                        
                    </div> --}}
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr class="info">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>

                                        <td>
                                            <input data-id="{{ $user->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>

                                        </td>

                                        <td>
                                            <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#exampleModalCenter" href=""> <i class="fa fa-eye" aria-hidden="true"></i> </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title" id="exampleModalLongTitle">Customer Detail</h2>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="table" class="table table-bordered table-striped table-hover text-center">
                                                      
                                                                    <tr>
                                                                        <td>No</td>
                                                                        <td>{{ $user->id }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>{{ $user->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email</td>
                                                                        <td>{{ $user->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Phone</td>
                                                                        <td>{{ $user->phone }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Address</td>
                                                                        <td>{{ $user->address->address }} / {{$user->address->township}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Address</td>
                                                                        <td>{{ $user->deliveryAddress->address }} / {{$user->deliveryAddress->township}}</td>
                                                                    </tr>
                                
                                
                                
                                                                <tbody>
                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{route('cupons.destroy', $user->id )}}" method="POST" style="display:inline-block; margin-left:5px"
                                                id="delForm{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $user->id }}"
                                                    class="btn btn-danger btn-sm del"><i class="fa fa-trash"
                                                        aria-hidden="true"> </i></button>
                                            </form>
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

                    url: '/admin/changeStatus/users',

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




    <script>
        // $(function() {
        //     $('#table').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '/admin/datatable/categories/',
        //         columns: [{
        //                 data: 'id',
        //                 name: 'id'
        //             },
        //             {
        //                 data: 'name',
        //                 name: 'name'
        //             },
        //             {
        //                 data: 'action',
        //                 name: 'action'
        //             },
        //             {
        //                 data: 'status',
        //                 name: 'status'
        //             },
        //             {
        //                 data: 'created_at',
        //                 name: 'created_at'
        //             }


        //         ]

        //         // ,
        //         // "order": [
        //         //     [3, 'desc']
        //         // ]
        //     });

        // });


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

                    setTimeout(function() {
                        $('#delForm' + id).submit();
                    }, 2000);


                }
            })

        });




        // $(document).on('click', '.statusUnactive', function() {

        //     var id = $(this).data('id');

        //     Swal.fire({
        //         title: 'Are you sure to inactive?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Cofirm',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {

        //             Swal.fire(
        //                 'Completed!!!',
        //                 'The status is inactive now.',
        //                 'success'
        //             )

        //             setTimeout(function() {
        //                 $('#statusForm' + id).submit();
        //             })


        //         }
        //     })

        // });


        // $(document).on('click', '.statusActive', function() {

        //     var id = $(this).data('id');

        //     Swal.fire({
        //         title: 'Are you sure to active?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Cofirm',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {

        //             Swal.fire(
        //                 'Completed!!!',
        //                 'The status is active now.',
        //                 'success'
        //             )

        //             setTimeout(function() {
        //                 $('#statusForm' + id).submit();
        //             })


        //         }
        //     })

        // });
    </script>

@endsection
