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
                                @if($categories->category_id != null)
                                    <li><a href="{{ route('cat.show',$categories->category->category_slug) }}">{{$categories->category->category_name}}</a></li>
                                @endif
                                @if($categories->sub_category_id != null)
                                    <li><a href="{{ route('subcat.show',$categories->subcategory->subcategory_slug) }}">{{$categories->subcategory->subcategory_name}}</a></li>
                                    @else
                                        <li> {{$categories->subcategory_name}}</li>
                                @endif
                                @if($categories->sub_category_id != null)
                                    <li>{{$categories->secondary_subcategory_name}}</li>
                                @endif
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
                                    <h4>All {{$categories->subcategory_name}}   {{$categories->secondary_subcategory_name}} Collection</h4>
                                </div>
                            </div>

                            @foreach($products as $product)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- category area End -->

    <!-- related-section area Start -->

    <section class="related-section">
        <div class="product_area ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3  class="text-dark text-center mb-20">Related Product</h3>
                    </div>
                </div>
                <div class="product_container">
                    @foreach($results as $mainRe)
                        <div class="row">
                                <div class="col-md-12"><h2 class="float-left">{{$mainRe->category->category_name}}</h2></div>

                                <div class="col-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                                            <div class="product_carousel product_column5 owl-carousel">
                                                @foreach($mainRe->category->products as $index => $ffgr)
                                                    <div class="product_items">
                                                        <article class="single_product">
                                                            <figure>
                                                                <div class="single_banner">
                                                                    <div class="banner_thumb">
                                                                        <a href="{{route('pages.show',$ffgr->id)}}">
                                                                            <img src="{{assetImageAndVideo('images') . $ffgr->feature_image}}" alt="{{$ffgr->product_name}}">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <figcaption class="product_content">
                                                                    <h4 class="product_name"><a href="{{route('pages.show',$ffgr->id)}}">{{$ffgr->product_name}}</a></h4>
                                                                    <div class="price_box">
                                                                        <span class="current_price">BDT {{$ffgr->product_price}}</span>
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
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- related-section area End -->

@endsection
