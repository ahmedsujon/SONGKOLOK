@extends('layouts.app_main')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li>Registration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--register area start-->
                <div class="col-lg-6 col-md-6 offset-md-3">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <form action="{{route('register')}}" method="post" autocomplete="off">
                            @csrf

                            <p>
                                <label>Firstname  <span>*</span></label>
                                <input type="text" name="fname" placeholder="Firstname" value="{{ old('fname') }}">
                                @error('fname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>

                            <p>
                                <label>Lastname  <span>*</span></label>
                                <input type="text" name="lname" placeholder="Lastname" value="{{ old('lname') }}">
                                @error('lname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>

                            <p>
                                <label>Email address  <span>*</span></label>
                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </p>

                            <p>
                                <label>Phone  <span>*</span></label>
                                <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>

                            <p>
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password" placeholder="Password">
                            </p>
                            <p>
                                <label>Confirm Passwords <span>*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                            <div class="login_submit">
                                <a href="{{ route('login') }}">Already register?</a>
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->

            </div>
        </div>
    </div>


@endsection
