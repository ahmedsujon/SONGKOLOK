@extends('layouts.app_main')

@section('content')

    <!-- company overview slider and map start   -->

    <section class="comany_overview">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="image_video">
                        <div class="bo-slider">
                            @if( isset($sliders) )
                                @php $i = 0; @endphp
                                @foreach($sliders as $index => $slider)
                                    @if( strcmp($slider->type, 'video') )
                                        <li data-url="{{ assetImageAndVideo('images') . $slider->slider_media }}" data-type="image"></li>
                                    @else
                                        <li data-url="{{ assetImageAndVideo('videos') . $slider->slider_media }}" id="video{{$i++}}" data-type="video">
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-3">
                    <div class="company_map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d58375.29717983309!2d90.418934!3d23.873441099999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1608043011219!5m2!1sen!2sbd" width="350" height="290" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section start -->


    <section class="company_contat">
        <div class="container">
            <div class="row">
                @if(isset($employees))
                    @foreach($employees as $employee)
                        <div class="col-md-3">
                            <span>{{$employee->designation_name}} Team </span>
                            @foreach($employee->employeeWithStatus as $employ)
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-4 no-gutter">
                                           <div class="car-img">
                                           <img src="{{assetImageAndVideo('images') . $employ->employee_image}}" alt="{{$employ->name}}" class="image-fluid">
                                           </div>
                                        </div>
                                        <div class="col-md-8 no-gutter">
                                            <div class="card-body">
                                                <p>{{$employee->designation_name}}</p>
                                                <p>ID: {{$employ->id}}</p>
                                                <p>{{$employ->name}}</p>
                                                <p>{{$employ->email}}</p>
                                                <p class="card-text"> {{$employ->phone}}</p>
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
                        <h3 class="title"><span>Head Office</span></h3>
                        <p class="address-line">House: 02, Road: 01, Turag City, Shah Ali, Mirpur-1, Dhaka-1216<br>Mobile: 01954154453</p>
                        <p class="closed-day">Friday Closed</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Mirpur Branch</span></h3>
                        <p class="address-line">S-107, Level-6, Shah Ali Shopping Complex, Mirpur-1, Dhaka-1216<br>Mobile: 01954154453</p>
                        <p class="closed-day">Friday Closed</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Narail Branch</span></h3>
                        <p class="address-line">1st Floor, Mustari Complex, <br> Rupganj Bazar Narail Sadar Narail<br>Mobile: 01954154453</p>
                        <p class="closed-day">Friday Closed</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="address">
                        <h3 class="title"><span>Fedi Bazar Branch</span></h3>
                        <p class="address-line">R1st Floor, Songkolok Tower, <br> Fedi bazar, Narail Sadar Narail<br>Mobile: 01954154453</p>
                        <p class="closed-day">Friday Closed</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">

                </div>
            </div>
        </div>
    </section>


    <!-- company overview slider and map end   -->

@endsection
