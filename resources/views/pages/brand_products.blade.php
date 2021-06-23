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
                                <li><a href="{{route('brands.show')}}">All Brand</a></li>
                                <li>{{$brands->brand_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="right-main-cat">

                        <div class="row">

                            <div class="col-md-12 ">
                                <div class="sub_head">
                                        <h4>All {{$brands->brand_name}} Collection</h4>
                                </div>
                            </div>

                            @foreach($products as $product)
                                <div class="col-md-3">
                                    <div class="right-category">
                                        <div class="card">
                                            <div class="zoom-In">
                                                <a href="{{route('pages.show',$product->product_slug)}}"><img src="{{assetImageAndVideo('images').$product->feature_image}}" class="card-img-top" alt="{{$product->product_name}}"></a>
                                            </div>
                                            <div class="card-body">
                                                <div class="pro_des">
                                                    <a class="float-left" href="{{route('pages.show',$product->product_slug)}}"><p>{{$product->product_name}}</p></a>
                                                    <div class="float-right product_ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="price_box text-center">
                                                    <p class="">Model : {{ $product->model }}</p>
                                                    <span class="current_price ">BDT {{ round($product->product_price) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <div class="blog_pagination">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="pagination">

                            {{$products->links()}}
                            {{--                        <ul>--}}
                            {{--                            <li class="current">{{$products->links()}}</li>--}}
                            {{--                            <li><a href="#">2</a></li>--}}
                            {{--                            <li><a href="#">3</a></li>--}}
                            {{--                            <li class="next"><a href="#">next</a></li>--}}
                            {{--                            <li><a href="#">&gt;&gt;</a></li>--}}
                            {{--                        </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- category area End -->




@endsection
