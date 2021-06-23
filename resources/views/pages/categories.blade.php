@extends('layouts.app_main')

@section('content')

    <!--slider area start-->
    <div class="container image_video">
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

    <!--  Category bottom Code Start     -->

    <section class="category_bottom mt-4 mb-4">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-2">
                        <div class="category-inner">
                            <a href="{{route('subcat.show',$category->subcategory_slug)}}"><img src="{{assetImageAndVideo('images') .$category->sub_category_image}}" alt=""></a>
                            <a href="{{route('subcat.show',$category->subcategory_slug)}}">
                                <p>{{$category->subcategory_name}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- related-section area Start -->

    <section class="related-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3  class="text-dark text-center mb-20">Related Product</h3>
                </div>
            </div>

            @foreach($categories as $category)
                @if( count($category->productWithStatus) > 0 )
                    <div class="row">
                        <div class="col-md-10">
                            <h3>{{$category->subcategory_name}}</h3>
                        </div>
                        <div class="col-md-2">
                            <h2><a href="{{route('subcat.show',$category->subcategory_slug)}}">View more</a></h2>
                        </div>
                    </div>
                    <div class="row">
                    @foreach($category->productWithStatus as $product)
                        <div class="col-md-3">
                            <div class="right-category">
                                <div class="card">
                                    <div class="zoom-In">
                                        <a href="{{route('pages.show',$product->product_slug)}}"><img src="{{assetImageAndVideo('images') .$product->feature_image}}" class="card-img-top" alt="{{$product->product_name}}"></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="pro_des col-md-12">
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

                                        <div class="price_box col-md-12">
                                            <span class="current_price ">BDT {{ round($product->product_price) }}</span>
                                            <p class="">Model : {{ $product->model }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            @endforeach
            {{ $categories->links() }}
        </div>
    </section>

    <!-- related-section area End -->

@endsection
