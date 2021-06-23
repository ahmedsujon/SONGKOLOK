@extends('layouts.app_main')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area" style="background-color: darkslategray">
        <div class="container">
            <div class="row">
                <div class="col-12" >
                    <div class="breadcrumb_content_new text-left" >
                        <ul style="color: #cfcfcf; font-weight: 600;">
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li>নবাবীহাট</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $count_date = date('Y-m-d H:i:s', time()+6*3600);
    @endphp
    <section class="category">
        <div class="container card">
            <div class="row" style="background-color: #1e2b37">
                @if(isset($event))
                    @php
                        $datetime1 = new \DateTime($event->start_date);
                        $datetime2 = new \DateTime($count_date);
                        $interval = $datetime1->diff($datetime2);
                        $elapsed = $interval->format('%a days        %h : %i : %S ');

                    @endphp
                        <div class="col-md-6 text-center" style="padding: 15px">
                            <img style="max-width: 60%" src="{{assetImageAndVideo('images' ).$event->event_image}}" class="card-img-top" alt="{{$event->event_name}}">
                        </div>
                        <div class="col-md-6 text-center" style="padding-top: 80px;">
                            <h4 class="text-white text-uppercase">{{$event->event_name}} STARTING IN</h4>
                            <p class="text-white text-uppercase">{{\Carbon\Carbon::parse($event->start_date)->format('d M  Y')}}</p>
                            <h1 class="text-white text-uppercase" data-start-date="{{$event->start_date}}"  id="time_difference" >{{$elapsed}}</h1>
                            <a href="{{route('promotion.category')}}" class="btn btn-outline-success" id="nobabi_link">Go to নবাবীহাট</a>
                        </div>
                @endif
            </div>
        </div>
    </section>

    <!--breadcrumbs area end-->
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="right-main-cat">
                        <div class="row">
                            @foreach($eventProducts as $eventProduct)
                                @if($eventProduct->event->end_date > $count_date)
                                    <div class="col-md-4">
                                        <div class="right-category">
                                            <div class="card">
                                                <div class="zoom-In">
                                                    <a href="{{route('promotion.products',[$eventProduct->event_id,$eventProduct->category_id])}}"><img src="{{assetImageAndVideo('images' ).$eventProduct->category->category_image}}" class="card-img-top" alt="{{$eventProduct->category->category_name}}"></a>

                                                </div>
                                                <div class="card-body">
                                                    <a href="{{route('promotion.products',[$eventProduct->event_id,$eventProduct->category_id])}}">
                                                        <h4>{{ $eventProduct->event->event_name }} | {{$eventProduct->category->category_name}}</h4>
                                                    </a>
                                                    <p class="">Offer Active : {{\Carbon\Carbon::parse($eventProduct->event->start_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</p>
                                                    <p class="">To: {{\Carbon\Carbon::parse($eventProduct->event->end_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</p>
                                                    <div class="price_box text-center">
                                                        <span class="current_price float-left">BDT: {{$eventProduct->event->discount}}</span>
                                                        <a class="float-right" href="{{route('promotion.products',[$eventProduct->event_id,$eventProduct->category_id])}}">
                                                            view more
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if(!empty($eventProducts))
            <div class="blog_pagination">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <ul>
                                    <li>{{$eventProducts->links()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <!-- category area End -->


@endsection
