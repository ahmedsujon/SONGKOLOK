@extends('layouts.app_main')

@section('content')

    <!-- company overview slider and map start   -->

    <section class="comany_overview">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="slider_area owl-carousel">
                        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/company-overview.jpg">
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('frontend/assets/img/slider/main1.jpg') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_content">
                                            <h1>Company Overview</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/company-overview.jpg">
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('frontend/assets/img/slider/main1.jpg') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_content">
                                            <h1>Company Overview</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/company-overview.jpg">
                        <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('frontend/assets/img/slider/main1.jpg') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_content">
                                            <h1>Company Overview</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-3">
                    <div class="company_map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d58375.29717983309!2d90.418934!3d23.873441099999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1608043011219!5m2!1sen!2sbd" width="350" height="385" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d58375.29717983309!2d90.418934!3d23.873441099999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1608043011219!5m2!1sen!2sbd" width="350" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section start -->


    <section class="company_contat">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Sales Team </span>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Technical Team </span>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Logistics Team </span>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Admin Team </span>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="assets/img/user.png" class="image-fluid">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p>google@gmail.com</p>
                                    <p class="card-text">+088 01927474087</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($employees))
                    @foreach($employees as $employee)
                        <div class="col-md-3">
                            <span>{{$employee->designation_name}} Team </span>
                            @foreach($employee->employeeWithStatus as $employ)
                                 <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="zoom-In">
                                        <img src="{{url('images/' . $employ->employee_image)}}" alt="{{$employ->name}}" class="image-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <p class="card-text">{{$employ->name}}</p>
                                            <p class="card-text">{{$employ->email}}</p>
                                            <p class="card-text">+880 {{$employ->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- contact section end -->

    <section class="all_branch">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="branch_title">
                        <span>Our All Branches</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Gazipur Branch</span></h3>
                        <p class="address-line">Rowshan Shorok, Joydebpur Road, Gazipur Chowrasta, Gazipur<br>Desktop : 01709995400<br>Laptop: 01313717103</p>
                        <p class="closed-day">Friday Closed <a href="https://goo.gl/maps/5V8eL6mNYh7Q7dE57" target="_blank" rel="noopener"><span class="fa fa-map-marker" data-rating="1" alt="google-map"></span></a> </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Uttara Branch</span></h3>
                        <p class="address-line">Rowshan Shorok, Joydebpur Road, Gazipur Chowrasta, Gazipur<br>Desktop : 01709995400<br>Laptop: 01313717103</p>
                        <p class="closed-day">Friday Closed <a href="https://goo.gl/maps/5V8eL6mNYh7Q7dE57" target="_blank" rel="noopener"><span class="fa fa-map-marker" data-rating="1" alt="google-map"></span></a> </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Dhanmondi Branch</span></h3>
                        <p class="address-line">Rowshan Shorok, Joydebpur Road, Gazipur Chowrasta, Gazipur<br>Desktop : 01709995400<br>Laptop: 01313717103</p>
                        <p class="closed-day">Friday Closed <a href="https://goo.gl/maps/5V8eL6mNYh7Q7dE57" target="_blank" rel="noopener"><span class="fa fa-map-marker" data-rating="1" alt="google-map"></span></a> </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Mirpur Branch</span></h3>
                        <p class="address-line">Rowshan Shorok, Joydebpur Road, Gazipur Chowrasta, Gazipur<br>Desktop : 01709995400<br>Laptop: 01313717103</p>
                        <p class="closed-day">Friday Closed <a href="https://goo.gl/maps/5V8eL6mNYh7Q7dE57" target="_blank" rel="noopener"><span class="fa fa-map-marker" data-rating="1" alt="google-map"></span></a> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- company overview slider and map end   -->

@endsection

