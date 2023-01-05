<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('backend/dist/css/sweetalert.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/sweetalert-overrides.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/dist/css/login.css?v=1.5')}}">
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
        var token = "{{ csrf_token() }}";
    </script>
</head>
<body>
<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class=" alignText">
        <!-- <img src="{{asset('backend/dist/img/icon.png')}}" class="animation__shake logo"> -->
    </div>
    <div class="signup login-show">
        <form method="post" id="formWizard">
            @csrf
            <label for="chk" aria-hidden="true">Login</label>
            <span class="invalid-feedback auth_error" role="alert"></span>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="invalid-feedback" role="alert" style="color: red;"><strong>{{ $error }}</strong></span>
                @endforeach
            @endif
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
            <input type="text" name="username" class=" @error('username') is-invalid @enderror required" id="username"
                   required placeholder="Email">
            <input type="password" name="password" maxlength="50" id="password" placeholder="Password" required
                   class="required @error('password') is-invalid @enderror">
                   <button class="login-btn submitBtn" data-url="/admin">Login</button>
        </form>
    </div>

    <!-- <div class="login register-show">
        <form method="post">
            @csrf
            <label for="chk" aria-hidden="true">Forgot Password</label>
            <input type="text" placeholder="Email" maxlength="70" name="forgot_email" id="forgot_username">
            <input class="login-btn" type="button" value="Submit" id="forgot_password_btn">
        </form>
    </div> -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('backend/dist/js/sweetalert.min.js')}}"></script>
<script src="{{asset('backend/dist/js/sweetalert-init.js')}}"></script>
<script src="{{asset('backend/dist/js/custom.js')}}"></script>
</body>
</html>
