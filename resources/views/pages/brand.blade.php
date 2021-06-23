@extends('layouts.app_main')

@section('content')


<div class="shop_area shop_reverse mt-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_inner">
                        <div class="widget_list widget_categories">

                        <div class="widget_list widget_filter">
                            <h3>Filter by Brand <span> | <a id="reset" style="font-size: 10px">reset</a> </span> </h3>
                            <div>
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link text-center" id="top" >Top</a>
                                    <a class="nav-link text-center" id="mid" >Mid</a>
                                    <a class="nav-link text-center" id="low" >Low</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-12">
                <!--shop wrapper start-->
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">
                        {{ $brands->links() }}
                    </div>


                    <div class="page_amount">
                        @php
                            $queryString = ltrim(strrchr(request()->getQueryString(), '='), '=');
                        @endphp
                        <p>Showing
                            @if(!empty($queryString) && $queryString != 1)
                            {{ ((int)$queryString-1) * $brands->perPage() }}
                            @else 1 @endif
                            –{{ (!empty($queryString)) ? $queryString* $brands->perPage() : $brands->perPage()}} of {{$brands->total()}} results</p>
                    </div>
                </div>
                <!--shop toolbar end-->
                <div id="TOP" class="row shop_wrapper">
                    @if( $brands->where('level', 1)->count() > 0 )
                        <div class="top col-lg-12 col-md-12 col-sm-12 " id="hide1">
                            <div class="row">
                                <div class=" allBrands " >
                                    <h3 class="main_pro_img">TOP</h3>
                                    @php $allBrands = $brands->where('level', 1); @endphp
                                    @foreach($allBrands as $brand)
                                        <div class="col-lg-4 col-md-4 col-sm-6 float-left" >
                                            <div class="single_product" >
                                                <div class="product_thumb">
                                                    <a class="primary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                                    <a class="secondary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                                </div>
                                                <div class="product_content grid_content">
                                                    <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                                </div>
                                                <div class="product_content list_content">
                                                    <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($brands->where('level', 2)->count() > 0)
                        <div class="mid col-lg-12 col-md-12 col-sm-12 " id="hide2" >
                       <div class="row">
                        <div  id="MID" class="allBrands ">
                            <h3 class="main_pro_img">MID</h3>
                            @php $allBrands = $brands->where('level', 2); @endphp
                            @foreach($allBrands as $brand)
                                <div class="col-lg-4 col-md-4 col-sm-6 float-left" >
                                    <div class="single_product" >
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                            <a class="secondary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                        </div>
                                        <div class="product_content grid_content">
                                            <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                        </div>
                                        <div class="product_content list_content">
                                            <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                       </div>
                   </div>
                    @endif

                    @if( $brands->where('level', 3)->count() > 0 )
                        <div class="low col-lg-12 col-md-12 col-sm-12 " id="hide3">
                        <div class="row">
                            <div id="LOW" class=" allBrands ">
                                <h3 class="main_pro_img">LOW</h3>
                                @php $allBrands = $brands->where('level', 3); @endphp
                                @foreach($allBrands as $brand)
                                    <div class="col-lg-4 col-md-4 col-sm-6 float-left" >
                                        <div class="single_product" >
                                            <div class="product_thumb">
                                                <a class="primary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                                <a class="secondary_img" href="{{route('brandProduct.show',$brand->brand_slug)}}"><img src="{{assetImageAndVideo('images').$brand->brand_image}}" alt=""></a>
                                            </div>
                                            <div class="product_content grid_content">
                                                <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                            </div>
                                            <div class="product_content list_content">
                                                <h4 class="product_name"><a href="{{route('brandProduct.show',$brand->brand_slug)}}">{{$brand->brand_name}}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
</div>

@endsection
