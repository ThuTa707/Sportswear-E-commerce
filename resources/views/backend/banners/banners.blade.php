@extends('backend.layouts.master')

@section('title', 'Banner List')

@section('content')

<section class="content-header">
    <div class="header-icon">
      <i class="fa fa-image" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Banner</h1>
        <small>Banner List</small>
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
                            <h4>Banner List</h4>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="btn-group">
                        <div class="buttonexport" id="buttonlist">
                            <a class="btn btn-add" href="{{route('banners.create')}}"> <i class="fa fa-plus"></i> Add Banner
                            </a>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info">
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Text Style</th>
                                    <th>Link</th>
                                    <th>Sort Order</th>
                                    <th>Image</th>
                                    <th>User</th>
                                    <th style="width: 50px">Action</th>
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
            ajax: '/admin/datatable/banners/',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'content',
                    name: 'content'
                },
                {
                    data: 'text_style',
                    name: 'text_style'
                },
                {
                    data: 'link',
                    name: 'link'
                },
                {
                    data: 'sort_order',
                    name: 'sort_order'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'admin_id',
                    name: 'admin_id'
                },
                {
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }


            ]
            // ,
            // "order": [[9, 'desc']]
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


  
</script>

@endsection
