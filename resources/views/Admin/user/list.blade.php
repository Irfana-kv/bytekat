@extends('Admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="nav-icon fas fa-user-shield"></i> Manage User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">User</li>
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
                            <a href="{{url('users/create')}}" class="btn btn-success pull-right">Add User <i class="fa fa-plus-circle pull-right mt-1 ml-2"></i></a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="not-sortable">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userList as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{$user->type}}</td>
                                        <td>
                                            <label class="switch">
                                                <input id="switch-state-{{$loop->iteration}}" type="checkbox" class="status_check" data-size="mini" data-pk="{{ $user->id}}" {{($user->status=="Active")?'checked':''}}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{url('users/edit/'.$user->id)}}" class="btn btn-success mr-2 tooltips" title="Edit User"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger mr-2 deleteEntry tooltips" data-id="{{$user->id}}" title="Delete User"><i class="fas fa-trash"></i></a>
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
    $(document).on('change', '.status_check', function (event) {
        var state = $(this).is(':checked');
        var primary_key = $(this).data('pk');
        var _token = token;
        $.ajax({
            type: 'POST', dataType: 'json', url: 'users/status-change', data: {
                'state': state,
                primary_key: primary_key,
                _token: _token,
            }, success: function (response) {
                if (response.status == true) {
                    swal({
                        title: "Done it!",
                        text: response.message,
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                }else if(response.status === 'reload'){
                    swal({
                        title: "Done it!",
                        text: response.message,
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    window.location.reload();
                } else {
                    swal({
                        title: "Error", text: response.message, type: "error", showConfirmButton: false, timer: 1000,
                    }, function () {
                        window.location.reload();
                    });
                }
            }
        });
    });

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
                        url: 'users/delete/'+id,
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