<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    <div class="language_currency">
                        <ul>
                            <li class="language"><a href="#" style="color:#999999" id="time"></a>

                            </li>
                            @if(! \Illuminate\Support\Facades\Auth::check())
                            <li><a href="{{route('register')}}">{{ __('Sign Up') }}</a></li>
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                            <li><a href="{{route('logout')}}"
                                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"
                                >{{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <div class="header_social text-right">
                        @php $categories = \App\Models\Category::with(['subcategory', 'subcategory.secondary_sub_categories'])->orderBy('created_at','desc')->GetActive()->get();  @endphp
                    </div>
                    <div class="search_container">
                        <form action="{{route('pages.search')}}" method="get" enctype="multipart/form-data">
                            <div class="hover_category">
                                <select class="select_option" name="category_name" id="categori1">
                                    <option selected disabled value="" >Select a categories</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->category_name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="search_box">
                                <input name="product_name" placeholder="Search product..." type="text"><a href=""><i class="fa fa-camera" aria-hidden="true"></i></a>
                                <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                            </div>
                        </form>
                    </div>


                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active">
                                <a href="{{url('/')}}">Home</a>
                            </li>

                            <li class="has-child c-1">
                                <a href="#">E-CAMP</a>
                                <ul class="drop-down drop-menu-1">
                                    <li><a href="{{ route('brands.show') }}">Brand</a></li>
                                    <li><a href="{{ route('allVendor.show') }}">Shop</a></li>

                                </ul>
                            </li>

                            @php
                                $id = substr(strrchr(url()->current(), '/'), 1 );
                            @endphp
                            @if(route('topSale.show',$id) == url()->current() || route('overview',$id) == url()->current())
                                <li class="menu-item-has-children">
                                <a href="{{route('topSale.show',$id)}}">Company Profile</a>
                                <ul class="sub-menu">
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Layouts</a>
                                        <ul class="sub-menu">

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @php
                                $id = substr(strrchr(url()->current(), '/'), 1 );
                            @endphp
                            @if(route('topSale.show',$id) == url()->current() || route('overview',$id) == url()->current())
                                <li class="menu-item-has-children">
                                    <a href="{{route('topSale.show',$id)}}">Company Profile</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('overview',$id)}}#sec1">Company Overview</a></li>
                                        <li><a href="{{route('overview',$id)}}#sec2">Company Capability</a></li>
                                        <li><a href="{{route('overview',$id)}}#sec3">Business Performance</a></li>
                                    </ul>

                                </li>
                            @endif


                            @if( \Illuminate\Support\Facades\Auth::check())
                                <li class="has-child c-1">
                                    <a href="#">Vlog</a>
                                    <ul class="drop-down drop-menu-1">
                                        <li><a href="{{ route('blog.allBog') }}">All Vlogs</a></li>
                                        <li><a href="{{ route('blog.create') }}">Create Vlog</a></li>

                                    </ul>
                                </li>
                                <li class="menu-item-has-children "><a href="{{route('profile.show')}}">Profile</a>
                                <li class="menu-item-has-children "><a href="{{route('wish.list')}}">Wishlist</a>
                            @else
                                <li class="has-child c-1 c-1"><a href="{{ route('blog.allBog') }}"> Vlog </a> </li>
                            @endif
                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i>songkolok@gmail.com</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->

<header>
    <div class="main_header">
        <div class="header_top">
            <div class="container-fluid">
                <div class="row">
                    <div class="main-header-inner">
                        <div class="col-lg-4 col-md-4">
                            <div class="language_currency">

                                <a href="#" id="time"></a>
                                <a href="#" id="time2"></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="language_currencys">
                                <a href=""><h4 class="ml23">GET APPS</h4></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="top_last">
                            <ul>
                                <li><a href="{{ route('contact.show') }}">+880 1954154453</a></li>
                            </ul>
                           </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="header_middle">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset('frontend/assets/songkolok.jpeg')}}" width="250px" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-10">

                        <div class="header_right_info">

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="search_container">
                                        <form action="{{route('pages.search')}}" method="get" enctype="multipart/form-data">

                                            <div class="hover_category">

                                                <select class="select_option" style="color:#000" name="category_name" id="categori2">
                                                    <option selected disabled value="">Select a categories</option>

                                                    @if(isset($categories))
                                                        @foreach($categories as $category)
                                                                <option value="{{$category->id}}">
                                                                    {{$category->category_name}}
                                                                </option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </div>

                                            <div class="search_box">
                                                <input name="product_name" placeholder="Search product..." type="text">
                                                <a href=""><i class="fa fa-camera" aria-hidden="true"></i></a>
                                                <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2 area_top">
                                    <div class="header_account_area">
                                        <div class="header_account_list register">
                                            <ul>
                                                @if(! \Illuminate\Support\Facades\Auth::check())
                                                    <li><a href="{{route('register')}}">{{ __('Signup') }}</a></li>
                                                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                                @else
                                                    <li><a href="{{route('logout')}}"
                                                           onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();"
                                                        >{{ __('Logout') }}</a></li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endif
                                            </ul>
                                        </div>

                                        @if( Session::has('cart') && \Illuminate\Support\Facades\Auth::check())
                                            <div class="header_account_list  mini_cart_wrapper">
                                            @php $addTocarts = Session::get('cart'); @endphp
                                               <a href="#" id="cardDiv"><span class="lnr lnr-cart"></span><span class="item_count">{{ count($addTocarts) }}</span></a>
                                                <!--mini cart-->
                                                <div class="mini_cart">
                                                    <div class="cart_gallery">
                                                        <div class="cart_close">
                                                            <div class="cart_text">
                                                                <h3>cart</h3>
                                                            </div>
                                                            <div class="mini_cart_close">
                                                                <a href="javascript:void(0)" id="cross"><i class="icon-x"></i></a>
                                                            </div>
                                                        </div>

                                                        @php
                                                            //$addTocarts = Session::get('cart');
                                                            $total=0;
                                                        @endphp
                                                        @if($addTocarts != null)
                                                        @foreach($addTocarts as $addTocart)

                                                            @php

                                                               // $price= $addTocart['quantity'] * $addTocart['product_price'];
                                                                $total += $addTocart['quantity'] * $addTocart['product_price'];

                                                            @endphp

                                                        <div class="cart_item">
                                                           <div class="cart_img">
                                                               <a href="#"><img src="{{assetImageAndVideo('images').$addTocart['feature_image']}}" alt=""></a>
                                                           </div>
                                                            <div class="cart_info">
                                                                <a href="#">{{$addTocart['product_name']}}</a>
                                                                <p>{{$addTocart['quantity']}} x <span> BDT{{$addTocart['quantity'] * $addTocart['product_price']}} </span></p>
                                                            </div>
                                                            <div class="cart_remove">
                                                                <form action="{{route('cart.destroy',$addTocart['id'])}}" method="post">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button type="submit"><i class="icon-x"></i></button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                        @endforeach
                                                            @endif
                                                    </div>
                                                    <div class="mini_cart_table">
                                                        <div class="cart_table_border">
                                                            <div class="cart_total mt-10">
                                                                <span>total:</span>
                                                                <span class="price">BDT {{$total}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mini_cart_footer">
                                                       <div class="cart_button">
                                                            <a href="{{route('cart.create')}}"><i class="fa fa-shopping-cart"></i> View cart</a>
                                                        </div>
                                                        <div class="cart_button">
                                                            <a href="{{ route('checkout') }}"><i class="fa fa-sign-in"></i> Checkout</a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--mini cart end-->
                                           </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="main-nav sticky-header ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-1">
                        <div class="location" style="text-align: center;margin-top:10px;">

                        </div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-10">
                        <nav class="nav" id="main-nav">
                            <ul class="responsive-menu">
                                <li class="has-child c-1">
                                    <a href="">E-CAMP</a>
                                    <ul class="drop-down drop-menu-1">
                                        <li><a href="{{route('brands.show')}}">Brand</a></li>
                                        <li><a href="{{route('allVendor.show')}}">Shop</a></li>
                                    </ul>
                                </li>

                                @php
                                    $id = substr(strrchr(url()->current(), '/'), 1 );
                                @endphp
                                @if(route('topSale.show',$id) == url()->current() || route('overview',$id) == url()->current())
                                <li class="has-child c-1">
                                    <a href="{{route('topSale.show',$id)}}">{{__('Company Profile')}}</a>
                                    <ul class="drop-down drop-menu-1">
                                        <li><a id="" href="{{route('overview',$id)}}#sec1">Company Overview</a></li>
                                        <li><a id="" href="{{route('overview',$id)}}#sec2">Company Capability</a></li>
                                        <li><a id="" href="{{route('overview',$id)}}#sec3">Business Performance</a></li>
                                    </ul>
                                </li>
                                @endif
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <li class="has-child c-2">
                                            <a href="{{route('cat.show',$category->category_slug)}}">{{$category->category_name}}
                                                @if( count($category->subcategory) >0 )
{{--                                                    <i class="fa fa-caret-down"></i>--}}
                                                @endif
                                            </a>
                                            @if( count($category->subcategory) >0 )
                                            <ul class="drop-down drop-menu-1">
                                                @foreach($category->subcategory as $cat)
                                                <li class="has-child ">
                                                    <a href="{{route('subcat.show',$cat->subcategory_slug)}}">{{$cat->subcategory_name}}</a>
                                                    @if( count($cat->secondary_sub_categories) > 0 )
                                                        <ul class="drop-down drop-menu-2">
                                                            @foreach($cat->secondary_sub_categories as $secondary_sub )
                                                                <li><a href="{{route('secondary_sub.show',$secondary_sub->secondary_subcategory_slug)}}">{{$secondary_sub->secondary_subcategory_name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                                @endif
                                        </li>
                                    @endforeach
                                @endif
                                @if( \Illuminate\Support\Facades\Auth::check())
                                    <li class="has-child c-1">
                                        <a href="#">Vlog</a>
                                        <ul class="drop-down drop-menu-1">
                                            <li><a href="{{ route('blog.allBog') }}">All Vlogs</a></li>
                                            <li><a href="{{ route('blog.create') }}">Create Vlog</a></li>

                                        </ul>
                                    </li>
                                    <li class="has-child c-1"><a href="{{route('profile.show')}}">Profile</a> </li>
                                    <li class="menu-item-has-children "><a href="{{route('wish.list')}}">Wishlist</a>
                                @else
                                    <li class="has-child c-1 c-1"><a href="{{ route('blog.allBog') }}"> Vlog </a> </li>
                                @endif
                                <li class=" anime"><a href="https://songkolok.com/"><h4 class="ml2">সংকলক</h4></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
