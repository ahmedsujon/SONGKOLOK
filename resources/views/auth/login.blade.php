@extends('layouts.app_main')

@section('content')



    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Login</h3>
{{--                        <ul>--}}
{{--                            <li><a href="{{ route('home') }}">home</a></li>--}}
{{--                            <li>Login</li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">

                <!--login area start-->
                <div class="col-lg-6 col-md-6 offset-md-3">
                    @if( Session::has('error') )
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif

                    @if( Session::has('success') )
                        <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="account_form">
{{--                        <h2>login</h2>--}}
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <p>
                                <label>Username or email <span>*</span></label>
                                <input type="email" name="email" value="{{old('email')}}" placeholder="Your Email" required>
                            </p>
                            <div class="form-group">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password" placeholder="Your Password" required>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 float-left">
                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ url('callback/google/handle') }}">
                                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-6 float-left">
                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ url('callback/facebook/handle') }}" style="
    background: #3B5499;
    color: #ffffff;
    padding: 8px 0 7px 0px;
    width: 100%;
    text-align: center;
    display: block;
    border-radius: 3px;
    position: relative;
    top: 3px;
    font-size: 16px;
">
                                            <i class="fa fa-facebook-square " style="padding-right: 16px;"></i>Login with Facebook
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="login_submit">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Lost Your Password?') }}
                                    </a>
                                @endif
                                <a href="{{route('register')}}">Registration now</a>
                                <label for="remember">
                                    <input id="remember" name="remember" value="true" type="checkbox">
                                    Remember me
                                </label>
                                <button type="submit">login</button>

                            </div>



                        </form>
                    </div>
                </div>
                <!--login area start-->

            </div>
        </div>
    </div>
    <!-- customer login end -->

@endsection
