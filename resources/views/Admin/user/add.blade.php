@extends('Admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="nav-icon fas fa-user-shield"></i> {{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('users')}}">User</a></li>
                        <li class="breadcrumb-item active">{{$key}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form role="form" id="formWizard" class="form--wizard" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Basic Information</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
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
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label> Name*</label>
                                <input type="text" name="name" maxlength="191" id="name" placeholder="Name" class="form-control required" autocomplete="off" value="{{old('name', @$user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label> Email*</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control required" autocomplete="off" value="{{ old('email',@$user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            @if(!@$user)
                            <div class="form-group col-md-6">
                                <label> Password*</label>
                                <input type="password" name="password" maxlength="191" id="password" placeholder="Password" class="form-control required" autocomplete="off" value="{{ old('password',@$user->password) }}" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                            <div class="form-group col-md-6">
                            <label> Type*</label>
                                <select class="form-control required" name="type" id="type" required>
                                    <option value="">Select Type</option>
                                    @foreach(['Admin','User'] as $type)
                                    <option value="{{ $type}}" {{(@$user->type==$type)?'selected':''}}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        

                    </div>
                    <div class="card-footer">
                        <input type="submit" name="btn_save" value="Submit" class="btn btn-primary pull-left submitBtn">
                        <button type="reset" id="reset_btn" class="btn btn-default">Cancel</button>
                        <img class="animation__shake loadingImg" src="{{asset('backend/dist/img/loading.gif')}}" style="display:none;">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection