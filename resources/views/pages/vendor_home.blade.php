@extends('layouts.app_main')

@section('content')

    <!--slider area start-->
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
    <!--slider area end-->

    <!-- Top Sales area Start -->

    <section class="related-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-dark text-center mb-20">Top Sales</h3>
                </div>
            </div>

            <div class="row">
                @foreach($productSales as $productSale)
                    @foreach($productSale->productsWithSold as $product)
                        <div class="col-md-3">
                            <div class="related_inner">
                                <div class="card">
                                    <div class="zoom-In">
                                    <a href="{{route('pages.show',$product->product_slug)}}">
                                        <img src="{{assetImageAndVideo('images') .$product->feature_image}}" alt="{{$product->product_name}}">
                                    </a>
                                </div>
                                    <div class="card-body">
                                        <h5 class="card-text"><a href="{{route('pages.show',$product->product_slug)}}">{{$product->product_name}}</a></h5>
                                        <p class="card-title">BDT: {{$product->product_price}}</p>
                                    </div>
                                </div>
                            </div>
                         </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </section>

    <!-- Top Sales area End -->



    <!-- Top Product area Start -->

    <section class="related-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-dark text-center mb-20">Top Product</h3>
                </div>
            </div>

            <div class="row">
                @foreach($productTops as $productSale)
                    @foreach($productSale->productsWithTop as $product)
                        <div class="col-md-3">
                            <div class="related_inner">
                                <div class="card">
                                    <div class="zoom-In">
                                    <a href="{{route('pages.show',$product->product_slug)}}">
                                        <img src="{{assetImageAndVideo('images') .$product->feature_image}}" alt="{{$product->product_name}}">
                                    </a>
                                </div>
                                    <div class="card-body">
                                        <h5 class="card-text"><a href="{{route('pages.show',$product->product_slug)}}">{{$product->product_name}}</a></h5>
                                        <p class="card-title">BDT: {{$product->product_price}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </section>

    <!-- Top Product area End -->


    <!-- Business area Start -->

    <section class="related-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-dark text-center mb-20">Show View</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="related_inner">
                                @foreach($showViews as $showView)
                                    <div class="card">
                                        <div class="zoom-In">
                                        <a href="#"><img src="{{ assetImageAndVideo('images') . $showView->image}}"/></a>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{{$showView->description}}</p>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-dark text-center mb-20">Factory View</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="related_inner">
                                @foreach($factoryViews as $factoryView)
                                    <div class="card">
                                        <div class="zoom-In">
                                        <a href="#"><img src="{{ assetImageAndVideo('images') . $factoryView->image}}" /></a>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{{$factoryView->description}}</p>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- Business area End -->


@endsection
