@extends('Admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="nav-icon fas fa-user-shield"></i> Manage Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <a href="{{url('product/create')}}" class="btn btn-success pull-right">Add Product <i class="fa fa-plus-circle pull-right mt-1 ml-2"></i></a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th class="not-sortable">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productList as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ @$product->category->title }}</td>
                                        <td>Rs{{ $product->price }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{url('product/edit/'.$product->id)}}" class="btn btn-success mr-2 tooltips" title="Edit Product"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger mr-2 deleteEntry tooltips" data-id="{{$product->id}}" title="Delete Product"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).on('click', '.deleteEntry', function () {
        var id = $(this).data('id');
        var _token = token;
        if (id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: 'product/delete/'+id,
                        data: {id: id, _token: _token},
                        success: function (data) {
                            if (data.status == false) {
                                swal('Error !', data.message, 'error');
                            } else {
                                swal({
                                    title: "Success",
                                    text: "Entry has been deleted!",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 1000,
                                }, function () {
                                    location.reload();
                                });
                            }
                        }
                    })
                } else {
                    swal("Cancelled", "Entry remain safe :)", "error");
                }
            });
        } else {
            swal('Error !', 'Entry not found', 'error');
        }
    });
</script>

@endsection