<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="admin_sidebar_nav_link nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a id="navbarDropdown" class="admin_sidebar_nav_link nav-link dropdown-toggle text-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::guard('admin')->user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
{{--        <img src="{{ asset('frontend/assets/img/logo/logo3.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
            <span class="brand-text  font-weight-light">Admin Songkolok | {{ Auth::guard('admin')->user()->name }}</span>
        @else
            <span class="brand-text font-weight-light">Vendor Songkolok | {{ Auth::guard('admin')->user()->name }}</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="admin_sidebar_nav_link nav-link @if(url()->current() == route('admin.dashboard') ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.express.wish') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('admin.express.wish')
    ) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Express Wish</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('sell.report') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('sell.report')
    ) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sell Report</p>
                    </a>
                </li>

                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                    <li class="nav-item">
                        <a href="{{route('admin.all.user.no.order')}}" class="admin_sidebar_nav_link nav-link @if(
                                        url()->current() == route('admin.all.user.no.order')
        ) active @endif ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                All Users
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.blog')}}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('admin.blog')
    ) active @endif ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Manage Blog
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('vendor.allVendor')}}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('vendor.allVendor')
    ) active @endif ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                All Vendors
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item @if(
                                    url()->current() == route('brand.create') ||
                                    url()->current() == route('admin.all.brand') ||
                                    url()->current() == route('brand.index')
    ) menu-is-opening menu-open @endif">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('brand.create') ||
                                    url()->current() == route('admin.all.brand') ||
                                    url()->current() == route('brand.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Brand
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('brand.create') ||
                                    url()->current() == route('admin.all.brand') ||
                                    url()->current() == route('brand.index')
    ) style="display: block" @endif >
                        <li class="nav-item">
                            <a href="{{ route('brand.create') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('brand.create' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('brand.index' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Brand</p>
                            </a>
                        </li>
                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                            <li class="nav-item">
                                <a href="{{ route('admin.all.brand') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if( url()->current() == route('admin.all.brand' ) )active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vendor Brand</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>


                <li class="nav-item @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index') ||
                                    url()->current() == route('subcategory.index') ||
                                    url()->current() == route('subcategory.create') ||
                                    url()->current() == route('admin.all.subcategory') ||
                                    url()->current() == route('secondsub.create') ||
                                    url()->current() == route('secondsub.index')
    ) menu-is-opening menu-open @endif ">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index') ||
                                    url()->current() == route('subcategory.index') ||
                                    url()->current() == route('subcategory.create') ||
                                    url()->current() == route('admin.all.subcategory') ||
                                    url()->current() == route('secondsub.create') ||
                                    url()->current() == route('secondsub.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index')
    ) style="display: block" @endif  >
                        <li class="nav-item @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index')
    ) menu-is-opening menu-open  @endif  ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Main Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('category.create') ||
                                    url()->current() == route('admin.all.category') ||
                                    url()->current() == route('category.index')
    ) style="display: block" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('category.create')
    ) active @endif ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('category.index')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Category Manage</p>
                                    </a>
                                </li>
                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.category') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(
                                    url()->current() == route('admin.all.category')
    ) active @endif  ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor Category</p>
                                        </a>
                                    </li>
                                 @endif


                            </ul>
                        </li>



                        <li class="nav-item @if(
                                    url()->current() == route('subcategory.index') ||
                                    url()->current() == route('subcategory.create') ||
                                    url()->current() == route('admin.all.subcategory')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subcategory.index') ||
                                    url()->current() == route('subcategory.create') ||
                                    url()->current() == route('admin.all.subcategory')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Sub Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('subcategory.index') ||
                                    url()->current() == route('subcategory.create') ||
                                    url()->current() == route('admin.all.subcategory')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subcategory.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Sub Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subcategory.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Manage Sub category</p>
                                    </a>
                                </li>
                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.subcategory') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(
                                    url()->current() == route('admin.all.subcategory')
    ) active @endif   ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor SubCategory</p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                        <li class="nav-item @if(
                                    url()->current() == route('secondsub.create') ||
                                    url()->current() == route('secondsub.index')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('secondsub.create') ||
                                    url()->current() == route('secondsub.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Second Sub Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('secondsub.create') ||
                                    url()->current() == route('secondsub.index')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('secondsub.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('secondsub.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Second Sub Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('secondsub.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('secondsub.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Manage Second Sub category</p>
                                    </a>
                                </li>
                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{ route('admin.all.subcategory') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(--}}
{{--                                    url()->current() == route('admin.all.subcategory')--}}
{{--    ) active @endif   ">--}}
{{--                                            <i class="far fa-dot-circle nav-icon"></i>--}}
{{--                                            <p>All Vendor SubCategory</p>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                @endif

                            </ul>
                        </li>



                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="admin_sidebar_nav_link nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            All Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="admin_sidebar_nav_link nav-link">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('product.create') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Product Manage</p>
                                    </a>
                                </li>

                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.product') }}" class="admin_sidebar_nav_link nav-link text-fuchsia">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor   Products</p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="admin_sidebar_nav_link nav-link">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>
                                    Product Image
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('productImage.create') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Upload Product Images</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('productImage.index') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Manage Product Images</p>
                                    </a>
                                </li>

                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.product.image') }}" class="admin_sidebar_nav_link nav-link text-fuchsia">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor Category</p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="admin_sidebar_nav_link nav-link">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>
                                    Product Videos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('productVideo.create') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Upload Product Video</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('productVideo.index') }}" class="admin_sidebar_nav_link nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Manage Product Video</p>
                                    </a>
                                </li>

                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.product.video') }}" class="admin_sidebar_nav_link nav-link text-fuchsia">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor Product Video</p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                    </ul>
                </li>

                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                    <li class="nav-item @if(
                                    url()->current() == route('employee.index') ||
                                    url()->current() == route('designation.create') ||
                                    url()->current() == route('designation.index') ||
                                    url()->current() == route('employee.create')
    ) menu-is-opening menu-open @endif ">
                        <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('employee.index') ||
                                    url()->current() == route('designation.create') ||
                                    url()->current() == route('designation.index') ||
                                    url()->current() == route('employee.create')
    ) active @endif ">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Employee Details
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview " @if(
                                    url()->current() == route('employee.index') ||
                                    url()->current() == route('designation.create') ||
                                    url()->current() == route('designation.index') ||
                                    url()->current() == route('employee.create')
    ) style="display: block" @endif >
                            <li class="nav-item @if(
                                    url()->current() == route('designation.create') ||
                                    url()->current() == route('designation.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('designation.index') ||
                                    url()->current() == route('designation.create')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Designation
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('designation.index') ||
                                    url()->current() == route('designation.create')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('designation.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('designation.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Designation</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('designation.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('designation.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Designation Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class="nav-item @if(
                                    url()->current() == route('employee.create') ||
                                    url()->current() == route('employee.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('employee.create') ||
                                    url()->current() == route('employee.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    <p>
                                        Employee
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('employee.create') ||
                                    url()->current() == route('employee.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{route('employee.create')}}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('employee.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Employee</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('employee.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('employee.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Employee</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item @if(
                                    url()->current() == route('event.create') ||
                                    url()->current() == route('admin.all.event') ||
                                    url()->current() == route('event.index')
    ) menu-is-opening menu-open @endif">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('event.create') ||
                                    url()->current() == route('admin.all.event') ||
                                    url()->current() == route('event.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Event
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('event.create') ||
                                    url()->current() == route('admin.all.event') ||
                                    url()->current() == route('event.index')
    ) style="display: block" @endif >
                        <li class="nav-item">
                            <a href="{{ route('event.create') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('event.create' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.index') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('event.index' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Event</p>
                            </a>
                        </li>
                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                            <li class="nav-item">
                                <a href="{{ route('admin.all.event') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if( url()->current() == route('admin.all.event' ) )active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vendor Event</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item @if(
                                    url()->current() == route('eventproduct.create') ||
                                    url()->current() == route('admin.all.eventProduct') ||
                                    url()->current() == route('eventproduct.index')
    ) menu-is-opening menu-open @endif">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('eventproduct.create') ||
                                    url()->current() == route('admin.all.eventProduct') ||
                                    url()->current() == route('eventproduct.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Event Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('eventproduct.create') ||
                                    url()->current() == route('admin.all.eventProduct') ||
                                    url()->current() == route('eventproduct.index')
    ) style="display: block" @endif >
                        <li class="nav-item">
                            <a href="{{ route('eventproduct.create') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('eventproduct.create' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Event Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('eventproduct.index') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('eventproduct.index' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Event Product</p>
                            </a>
                        </li>
                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                            <li class="nav-item">
                                <a href="{{ route('admin.all.eventProduct') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if( url()->current() == route('admin.all.eventProduct' ) )active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vendor Event Product</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>


                <li class="nav-item @if(
                                    url()->current() == route('emi.create') ||
                                    url()->current() == route('admin.all.emi') ||
                                    url()->current() == route('emi.index')
    ) menu-is-opening menu-open @endif">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('emi.create') ||
                                    url()->current() == route('admin.all.emi') ||
                                    url()->current() == route('emi.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            EMI
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('emi.create') ||
                                    url()->current() == route('admin.all.emi') ||
                                    url()->current() == route('emi.index')
    ) style="display: block" @endif >
                        <li class="nav-item">
                            <a href="{{ route('emi.create') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('emi.create' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create EMI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('emi.index') }}" class="admin_sidebar_nav_link nav-link @if( url()->current() == route('emi.index' ) )active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage EMI</p>
                            </a>
                        </li>
                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                            <li class="nav-item">
                                <a href="{{ route('admin.all.emi') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if( url()->current() == route('admin.all.emi' ) )active @endif ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vendor EMI</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


                <li class="nav-item @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index') ||
                                    url()->current() == route('categorySlider.index') ||
                                    url()->current() == route('categorySlider.create') ||
                                    url()->current() == route('admin.all.categorySlider')
    ) menu-is-opening menu-open @endif ">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index') ||
                                    url()->current() == route('categorySlider.index') ||
                                    url()->current() == route('categorySlider.create') ||
                                    url()->current() == route('admin.all.categorySlider')
    ) active @endif ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            All Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index')
    ) style="display: block" @endif  >
                        <li class="nav-item @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index')
    ) menu-is-opening menu-open  @endif  ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Slider
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('contactusslider.create') ||
                                    url()->current() == route('admin.all.slider') ||
                                    url()->current() == route('contactusslider.index')
    ) style="display: block" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('contactusslider.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('contactusslider.create')
    ) active @endif ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Slider</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contactusslider.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('contactusslider.index')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Slider Manage</p>
                                    </a>
                                </li>
                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.slider') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(
                                    url()->current() == route('admin.all.slider')
    ) active @endif  ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Vendor Slider</p>
                                        </a>
                                    </li>
                                @endif


                            </ul>
                        </li>



                        <li class="nav-item @if(
                                    url()->current() == route('categorySlider.index') ||
                                    url()->current() == route('categorySlider.create') ||
                                    url()->current() == route('admin.all.categorySlider')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('categorySlider.index') ||
                                    url()->current() == route('categorySlider.create') ||
                                    url()->current() == route('admin.all.categorySlider')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    Category Slider
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('categorySlider.index') ||
                                    url()->current() == route('categorySlider.create') ||
                                    url()->current() == route('admin.all.categorySlider')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('categorySlider.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('categorySlider.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Create Category Slider</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categorySlider.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('categorySlider.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Manage Category Slider</p>
                                    </a>
                                </li>
                                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                    <li class="nav-item">
                                        <a href="{{ route('admin.all.categorySlider') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(
                                    url()->current() == route('admin.all.categorySlider')
    ) active @endif   ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>All Category Slider</p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                    </ul>
                </li>


            @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                <li class="nav-item @if(
                                        url()->current() == route('division.create') ||
                                        url()->current() == route('division.index') ||
                                        url()->current() == route('district.index') ||
                                        url()->current() == route('district.create') ||
                                        url()->current() == route('city.create') ||
                                        url()->current() == route('city.index') ||
                                        url()->current() == route('subCity.create') ||
                                        url()->current() == route('subCity.index')
        ) menu-is-opening menu-open @endif ">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('division.create') ||
                                    url()->current() == route('division.index') ||
                                    url()->current() == route('district.index') ||
                                    url()->current() == route('district.create') ||
                                    url()->current() == route('city.create') ||
                                    url()->current() == route('city.index') ||
                                    url()->current() == route('subCity.create') ||
                                    url()->current() == route('subCity.index')
    ) active @endif ">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Product Delivery Area
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" @if(
                                    url()->current() == route('division.create') ||
                                    url()->current() == route('division.index')
    ) style="display: block" @endif  >
                        <li class="nav-item @if(
                                    url()->current() == route('division.create') ||
                                    url()->current() == route('division.index')
    ) menu-is-opening menu-open  @endif  ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('division.create') ||
                                    url()->current() == route('division.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    {{__('Division')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('division.create') ||
                                    url()->current() == route('division.index')
    ) style="display: block" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('division.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('division.create')
    ) active @endif ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p> {{ __('Create Division') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('division.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('division.index')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Division Manage') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item @if(
                                    url()->current() == route('district.index') ||
                                    url()->current() == route('district.create')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('district.index') ||
                                    url()->current() == route('district.create')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    {{__('District')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('district.index') ||
                                    url()->current() == route('district.create')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('district.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('district.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Create District') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('district.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('district.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Manage District') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item @if(
                                    url()->current() == route('city.create') ||
                                    url()->current() == route('city.index')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('city.create') ||
                                    url()->current() == route('city.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    {{ __('City') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('city.create') ||
                                    url()->current() == route('city.index')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('city.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('city.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Create City') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('city.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('city.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Manage City') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item @if(
                                    url()->current() == route('subCity.create') ||
                                    url()->current() == route('subCity.index')
    ) menu-is-opening menu-open @endif ">
                            <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subCity.create') ||
                                    url()->current() == route('subCity.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>
                                    {{ __('Sub City') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" @if(
                                    url()->current() == route('subCity.create') ||
                                    url()->current() == route('subCity.index')
    ) style="display: block" @else style="display: none" @endif  >
                                <li class="nav-item">
                                    <a href="{{ route('subCity.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subCity.create')
    ) active @endif  ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Create Sub City') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('subCity.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('subCity.index')
    ) active @endif   ">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{ __('Manage Sub City') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </li>
        @endif



                <li class="nav-item @if(
                                    url()->current() == route('coupon.index') ||
                                    url()->current() == route('coupon.create') ||
                                    url()->current() == route('admin.all.coupon')
    ) menu-is-opening menu-open @endif ">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('coupon.index') ||
                                    url()->current() == route('coupon.create') ||
                                    url()->current() == route('admin.all.coupon')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Coupon
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('coupon.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('coupon.create')
    ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Coupon</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('coupon.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('coupon.index')
    ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Coupon</p>
                            </a>
                        </li>

                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                            <li class="nav-item">
                                <a href="{{ route('admin.all.coupon') }}" class="admin_sidebar_nav_link nav-link text-fuchsia @if(
                                    url()->current() == route('admin.all.coupon')
    ) active @endif  ">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Vendor   Coupon</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item @if(
                                    url()->current() == route('orders.index') ||
                                    url()->current() == route('orders.create')
    ) menu-is-opening menu-open @endif ">
                    <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('orders.index') ||
                                    url()->current() == route('orders.create')
    ) active @endif ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Order
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('orders.index')
    ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Orders</p>
                            </a>
                        </li>
                        @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                        <li class="nav-item">
                            <a href="{{ route('orders.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('orders.create')
    ) active @endif text-fuchsia">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All vendor Order</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>


{{--                @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 2 )--}}
                    <li class="nav-item @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index') ||
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productCertification.index') ||
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index') ||
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index') ||
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index') ||
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index') ||
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index') ||
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) menu-is-opening menu-open @endif ">
                        <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index') ||
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productCertification.index') ||
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index') ||
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index') ||
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index') ||
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index') ||
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index') ||
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) active @endif ">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Vendors Details
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview" @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index') ||
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index') ||
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index') ||
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index') ||
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index') ||
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index') ||
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) style="display: block" @endif >
                            <li class="nav-item @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Product Capacity
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('productCapacity.create') ||
                                    url()->current() == route('productCapacity.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('productCapacity.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCapacity.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Capacity</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('productCapacity.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCapacity.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Capacity Manage</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productCertification.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productCertification.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-warning"></i>
                                    <p>
                                        Product Certification
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('productCertification.create') ||
                                    url()->current() == route('productCertification.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('productCertification.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCertification.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Certification</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('productCertification.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productCertification.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Certification</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-danger"></i>
                                    <p>
                                        Product Quality
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('productQuality.create') ||
                                    url()->current() == route('productQuality.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('productQuality.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productQuality.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Quality</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('productQuality.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productQuality.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Quality</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index')
    ) active @endif  ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Product RnD
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('productRnD.create') ||
                                    url()->current() == route('productRnD.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('productRnD.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productRnD.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create RnD</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('productRnD.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('productRnD.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage RnD</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Trade Capacity
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('tradeCapacity.create') ||
                                    url()->current() == route('tradeCapacity.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('tradeCapacity.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('tradeCapacity.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Trade</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tradeCapacity.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('tradeCapacity.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Trade</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Inspection Reports
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('factoryInspection.create') ||
                                    url()->current() == route('factoryInspection.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('factoryInspection.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryInspection.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Reports</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('factoryInspection.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryInspection.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Reports</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

{{--                            factory view && Show--}}
                            <li class="nav-item @if(
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Factory View
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('factoryView.create') ||
                                    url()->current() == route('factoryView.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('factoryView.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryView.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Factory View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('factoryView.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('factoryView.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Factory View</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item @if(
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) menu-is-opening menu-open @endif ">
                                <a href="#" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) active @endif ">
                                    <i class="far fa-circle nav-icon text-primary"></i>
                                    <p>
                                        Show View
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" @if(
                                    url()->current() == route('showView.create') ||
                                    url()->current() == route('showView.index')
    ) style="display: block" @endif >
                                    <li class="nav-item">
                                        <a href="{{ route('showView.create') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('showView.create')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Create Show View</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('showView.index') }}" class="admin_sidebar_nav_link nav-link @if(
                                    url()->current() == route('showView.index')
    ) active @endif ">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Manage Show View</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </li>
{{--                @endif--}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
