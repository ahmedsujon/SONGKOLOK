<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Admin | Sign In</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminasset/dist/css/adminlte.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Admin Sing Up</b></a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
                <form action="{{route('admin.register.submit')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" required class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" required class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

{{--                    <div class="body bg-gray">--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="text" name="name" class="form-control" placeholder="Full name" required/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="email" name="email" class="form-control" placeholder="Admin Email" required/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="password" name="password" class="form-control" placeholder="Password" required/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required/>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-4">
                        <button type="submit" class="btn btn-outline-primary btn-block">Register</button>
                    </div>

{{--                        <a href="{{route('admin.login')}}" class="text-center">I already have a membership</a>--}}

                </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
{{--                <a href="#" class="btn btn-block btn-primary">--}}
{{--                    <i class="fab fa-facebook mr-2"></i>--}}
{{--                    Sign up using Facebook--}}
{{--                </a>--}}
{{--                <a href="#" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i>--}}
{{--                    Sign up using Google+--}}
{{--                </a>--}}
            </div>

            <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('adminAsset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminAsset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminAsset/dist/js/adminlte.min.js') }}"></script>
</body>
</html>



<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

</body>
</html>
