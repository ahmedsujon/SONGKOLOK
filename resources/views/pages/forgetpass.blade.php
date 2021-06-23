@extends('layouts.app_main')

@section('content')
 

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Reset Password</li>
                        </ul>
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
                    <div class="account_form">
                        <h2>Reset Password</h2>
                        <form action="#">
                            <p>   
                                <label>Old Password<span>*</span></label>
                                <input type="password">
                             </p>
                             <p>   
                                <label> New Passwords <span>*</span></label>
                                <input type="password">
                             </p>   
                            <div class="sumit">
                                
                                <button type="submit">Save Change</button>
                                
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