@extends('backend.layouts.master')

@section('title', 'Product Attribute')

@section('content')


<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-product-hunt" aria-hidden="true"></i>
    </div>
    <div class="header-title">
        <h1>Product Attribute</h1>
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
                            <i class="fa fa-list" aria-hidden="true"></i>Product Attribute</a>
                    </div>
                </div>
                <div class="panel-body cus-attribute">
                    <form class="col-sm-8" action="{{ route('products.attributes.store', $product->id) }}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="">Product Name : {{ $product->name }}</label>
                        </div>

                        <div class="form-group">
                            <label for="">Product Code : {{ $product->code }}</label>
                        </div>

                        <div class="form-group">
                            <label for="">Product Category : {{ $product->category->name }}</label>
                        </div>

                        <div class="field_wrapper">
                            <div style="display: flex">
                                <input class="form-control" type="text" name="codes[]" value="" placeholder="Attr Code"
                                    style="width: 120px" />
                                <input class="form-control" type="text" name="sizes[]" value="" placeholder="Size" style="width: 120px" />
                                <input class="form-control" type="number" name="stocks[]" value="" placeholder="Stock"
                                    style="width: 120px" />
                                    <input class="form-control" type="number" name="price[]" value="" placeholder="Price"
                                    style="width: 120px" />
                                <a href="javascript:void(0);" class="add_button" style="margin: 8px 0px 0px 5px" title="Add field"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Input</a>
                            </div>
                        </div>

                        <div class="reset-button">
                            <button class="btn btn-success">Add Attribute</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="panel-body">
               
                    <div class="table-responsive">

                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="info text-center">
                                    <th class="text-center">No</th>
                                    {{-- <th class="text-center">Product</th> --}}
                                    {{-- <th class="text-center">Code</th> --}}
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Price</th>
                                    <th  class="text-center">Stock</th>
                                    <th class="text-center">Action</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($attributes as $attribute)
                                    <tr>

                                        <form action="{{ route('attributes.update', $attribute->id) }}" method="POST" id="attr_update{{$attribute->id}}">
                                            @csrf
                                            @method('PATCH')
                                            <td>{{ $attribute->id }}</td>
                                            {{-- <td>{{ $attribute->product->name }}</td> --}}
                                            {{-- <td><input type="text" class="form-control text-center" name="code"
                                                    value="{{ $attribute->code }}" /></td> --}}
                                            <td><input type="text" class="form-control text-center" name="size"
                                                    value="{{ $attribute->size }}" /></td>
                                                    <td><input type="number" class="form-control text-center" name="price"
                                                        value="{{ $attribute->price }}" /></td>
                                            <td><input type="text" class="form-control text-center" name="stock"
                                                    value="{{ $attribute->stock }}" /></td>

                                        </form>
                                        <td class="text-center">

                                            <button form="attr_update{{$attribute->id}}" class="btn btn-warning btn-sm">Update</button>




                                            <form action="{{ route('attributes.destroy', $attribute->id) }}"
                                                method="POST" style="display:inline-block; margin-left:5px"
                                                id="att_del{{ $attribute->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $attribute->id }}"
                                                    class="btn btn-danger btn-sm del"><i class="fa fa-trash"
                                                        aria-hidden="true"> </i></button>
                                            </form>

                                        </td>
                                        <td> <i class="fa fa-calendar" aria-hidden="true"></i> {{ $attribute->created_at->format('d-m-Y') }}
                                            <br>
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $attribute->created_at->format('H:ia') }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                           
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

<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            ` <div style="display: flex"> <input class="form-control" type="text" name="codes[]" value="" placeholder="Attr Code" style="width: 120px; margin-top:10px" /> 
            <input class="form-control" type="text" name="sizes[]" value="" placeholder="Size" style="width: 120px; margin-top:10px" />
            <input class="form-control" type="number" name="stocks[]" value="" placeholder="Stock" style="width: 120px; margin-top:10px" />
            <input class="form-control" type="number" name="price[]" value="" placeholder="Price" style="width: 120px; margin-top:10px" />.
            <a href="javascript:void(0);" class="remove_button" style="margin: 8px 0px 0px 5px" title="Add field"> <i class="fa fa-times-circle" aria-hidden="true"></i> Remove Input</a></div>`; //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function() {
        $('#table').DataTable();
    });



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
                    'Your attribute has been deleted.',
                    'success'
                )

                $('#att_del' + id).submit();

            }
        })

    });
</script>



@endsection
