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

<!--  Section Product slider Start  -->
<div class="product_area ">
    <div class="container">
        <div class="product_container">
            @if( count($recommend) > 0 )
            <div class="row">
                    <div class="col-md-12"><h2>Recommend Products</h2></div>
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                                <div class="product_carousel product_column4 owl-carousel">
                                    @foreach($recommend as $index => $pro)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="single_banner">
                                                        <div class="banner_thumb">
                                                            <div class="zoom-In">
                                                                <a href="{{route('pages.show',$pro->product->product_slug)}}">
                                                                    <img src="{{assetImageAndVideo('images') .$pro->product->feature_image}}" alt="{{$pro->product->product_name}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a href="{{route('pages.show', $pro->product->product_slug)}}">{{$pro->product->product_name}}</a></h4>
                                                        <div class="price_box">
                                                            <span class="current_price">BDT {{ round($pro->product->product_price) }}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <span>C</span>
                        <span>a</span>
                        <span>t</span>
                        <span>e</span>
                        <span>g</span>
                        <span>o</span>
                        <span>r</span>
                        <span>i</span>
                        <span>e</span>
                        <span>s</span>

                      </h2>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                            <div class="product_carousel product_column4 owl-carousel">
                                    @foreach($categories as $category)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="single_banner">
                                                        <div class="banner_thumb">
                                                          <div class="zoom-In">
                                                            <a href="{{route('cat.show',$category->category_slug)}}">
                                                                <img src="{{assetImageAndVideo('images') . $category->category_image}}" alt="{{$category->category_name}}">
                                                            </a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a href="{{route('cat.show',$category->category_slug)}}">{{$category->category_name}}</a></h4>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <span>B</span>
                        <span>e</span>
                        <span>s</span>
                        <span>t</span>
                        <span></span>
                        <span>s</span>
                        <span>e</span>
                        <span>l</span>
                        <span>l</span>
                        <span>e</span>
                        <span>r</span>
                      </h2>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                            <div class="product_carousel product_column4 owl-carousel">
                                    @foreach($products as $product)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="single_banner">
                                                        <div class="banner_thumb">
                                                         <div class="zoom-In">
                                                            <a href="{{route('pages.show',$product->product_slug)}}">
                                                                <img src="{{assetImageAndVideo('images') .$product->feature_image}}" alt="{{$product->product_name}}">
                                                            </a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a href="{{route('pages.show',$product->product_slug)}}">{{$product->product_name}}</a></h4>
                                                        <div class="price_box">
                                                            <span class="current_price"></span>
                                                            <span class="current_price">BDT: {{ round($product->product_price) }}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($results as $mainRe)
                @if(count($mainRe->products) > 0)
                    <div class="row">
                <div class="col-md-12"><h2>{{$mainRe->category_name}}</h2></div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                            <div class="product_carousel product_column4 owl-carousel">
                                @foreach($mainRe->products as $index => $pro)
                                    <div class="product_items">
                                        <article class="single_product">
                                            <figure>
                                                <div class="single_banner">
                                                    <div class="banner_thumb">
                                                        <div class="zoom-In">
                                                        <a href="{{route('pages.show',$pro->product_slug)}}">
                                                            <img src="{{assetImageAndVideo('images') .$pro->feature_image}}" alt="{{$pro->product_name}}">
                                                        </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <figcaption class="product_content">
                                                    <h4 class="product_name"><a href="{{route('pages.show', $pro->product_slug)}}">{{$pro->product_name}}</a></h4>
                                                    <div class="price_box">
                                                        <span class="current_price">BDT {{ round($pro->product_price) }}</span>


                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </div>
                                @endforeach
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
<!--product area end-->
@endsection
