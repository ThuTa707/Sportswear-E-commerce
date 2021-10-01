@extends('backend.layouts.master')

@section('title', 'Category List')

@section('content')

<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-list" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Category</h1>
        <small>Category List</small>
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
                            <h4>Category List</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{route('categories.create')}}"> <i class="fa fa-plus"></i> Add Category
                            </a>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class="info">
                                    <th>No</th>
                                    <th >Name</th>
                                    <th style="width: 150px">Action</th>
                                    <th style="width: 200px">Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{route('categories.edit', $category->id)}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                  
                                    <form action="{{route('categories.destroy', $category->id)}}" method="POST" style="display:inline-block; margin-left:5px" id="delForm{{$category->id}}">
                                        @method('DELETE')
                                        @csrf
                                             <button type="button" data-id="{{$category->id}}" class="btn btn-danger btn-sm del"><i class="fa fa-trash" aria-hidden="true"> </i></button>
                                        </form>
                                </td>


                                <td>
                                    <input data-id="{{$category->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $category->status ? 'checked' : '' }}>

                                </td>
                                
                                <td>
                                   <i class="fa fa-calendar" aria-hidden="true"></i> {{$category->created_at->format('d-m-Y')}}
                                   <br>
                                   <i class="fa fa-clock-o" aria-hidden="true"></i> {{$category->created_at->format('H:ia')}}
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
  
              url: '/admin/changeStatus',
  
              data: {'status': status, 'user_id': user_id},
  
              success: function(data){
  
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
                }, 1000);


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
