@extends('layouts.app_main')

@section('content')


    <div class="shop_area shop_reverse mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">
{{$factoryViews->links()}}
{{--                            <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"><i class="fa fa-th" aria-hidden="true"></i></button>--}}
{{--                            <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="List"><i class="fa fa-bars" aria-hidden="true"></i></button>--}}
                        </div>


                        <div class="page_amount">
                            @php
                                $queryString = ltrim(strrchr(request()->getQueryString(), '='), '=');
                            @endphp
                            <p>Showing
                                @if(!empty($queryString) && $queryString != 1)
                                    {{ ((int)$queryString-1) * $factoryViews->perPage() }}
                                @else 1 @endif
                                –{{ (!empty($queryString)) ? $queryString* $factoryViews->perPage() : $factoryViews->perPage()}} of {{$factoryViews->total()}} results</p>
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <div id="TOP" class="row shop_wrapper">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <h3></h3>
                        </div>
                        @foreach($factoryViews->unique('admin_id') as $factoryView)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12 ">
                                    <div class="single_product card">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('topSale.show',$factoryView->admin_id)}}"><img src="{{assetImageAndVideo('images').$factoryView->image}}" alt=""></a>
                                            <a class="secondary_img" href="{{route('topSale.show',$factoryView->admin_id)}}"><img src="{{assetImageAndVideo('images') .$factoryView->image}}" alt=""></a>
{{--                                            <div class="label_product">--}}
{{--                                                <span class="label_sale">Sale</span>--}}
{{--                                                <span class="label_new">New</span>--}}
{{--                                            </div>--}}

                                        </div>
                                        <div class="product_content grid_content">
                                            <p><a href="{{route('topSale.show',$factoryView->admin_id)}}">{{$factoryView->description}}</a></p>
                                        </div>
                                        <div class="product_content list_content">
                                            <p><a href="{{route('topSale.show',$factoryView->admin_id)}}">{{$factoryView->description}}</a></p>

                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>

@endsection
