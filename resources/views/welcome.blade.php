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

   <!--  Section Discover slider Start  -->

   <section class="discover-section">
       <div class="container-fluid">
          <div class="row">
              <div class=" col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="discover-title">
                      <h3>Discover</h3>
                  </div>
              </div>
          </div>
           <div class="row">
               <div class=" col-lg-12 col-md-12 col-sm-12 col-12">
                   <div class=" discover-carasul diecover_div owl-carousel">
                        <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover1.png')}}" alt=""></a>
                                </div>
                              <p>Shop in 7 language</p>
                            </div>

                        </div>
                          <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover3.png')}}" alt=""></a>
                                </div>
                              <p>Shop in 60 countries</p>
                            </div>

                        </div>
                       <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover2.png')}}" alt=""></a>
                                </div>
                              <p>Deals and promotions</p>
                            </div>

                        </div>

                       <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover4.png')}}" alt=""></a>
                                </div>
                              <p>secure payment</p>
                            </div>

                        </div>
                       <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover5.png')}}" alt=""></a>
                                </div>
                              <p>Estimated import fees</p>
                            </div>

                        </div>
                       <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover6.png')}}" alt=""></a>
                                </div>
                              <p>Estimated import fees</p>
                            </div>

                        </div>
                       <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover7.png')}}" alt=""></a>
                                </div>
                              <p>Track your package</p>
                            </div>

                        </div>
                        <div class="item">
                            <div class="single_banner">
                                <div class="banner_thumb">
                                    <a href="shop.html"><img src="{{asset('frontend/assets/img/icon/discover8.png')}}" alt=""></a>
                                </div>
                              <p>Estimated import fees</p>
                            </div>

                        </div>
                    </div>
               </div>
           </div>
       </div>
   </section>

   <!-- Section Discover slider End  -->


<!--  Section Product slider Start  -->
<div class="product_area ">
    <div class="container">
        <div class="product_container">
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
                            <div class="product_carousel product_column5 owl-carousel">
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
                            <div class="product_carousel product_column5 owl-carousel">
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
{{--@php  print_r($mainRe->products); @endphp--}}
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                            <div class="product_carousel product_column5 owl-carousel">
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
