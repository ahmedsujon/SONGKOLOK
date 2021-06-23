@extends('layouts.app_admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create Slider'
        ])

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Create Brand</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('contactusslider.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Slider Image (upload multiple) </label>
                                        {{--                                        <input multiple type="file" name="product_image[]" class="form-control-file" id="exampleFormControlFile1">--}}
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" name="slider_media[]" multiple class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            @error('slider_media')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleSelectRounded0">Status</label>
                                        <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleSelectRounded0">Slider for</label>
                                        <select name="for" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                            @if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 1 )
                                                <option value="1">Home</option>
                                                <option value="0">Contact</option>
                                            @else
                                            <option value="2">Vendor</option>
                                                @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left mt-2">
                                        <label for=""> </label>
                                        <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
                                    </div>

                                </div>
                                <!-- /.card-body -->

{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>--}}
{{--                                </div>--}}
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>










{{--    <div class="wrapper row-offcanvas row-offcanvas-left">--}}
{{--        <!-- Left side column. contains the logo and sidebar -->--}}
{{--    @include('layouts.admin_sidebar')--}}

{{--    <!-- Right side column. Contains the navbar and content of the page -->--}}
{{--        <aside class="right-side">--}}


{{--            <!-- Main content -->--}}
{{--            <section class="content">--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <!-- general form elements -->--}}
{{--                        <div class="box box-primary">--}}
{{--                            <div class="box-header">--}}
{{--                                <h3 class="box-title">Create Brand</h3>--}}
{{--                            </div><!-- /.box-header -->--}}
{{--                            <!-- form start -->--}}
{{--                            <form role="form" action="{{route('brand.store')}}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <div class="box-body">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputPassword1">Slider Image or Video ( can select multiple )</label>--}}
{{--                                        <input type="file" name="slider_media[]" multiple class="custom-file-input" id="exampleInputFile">--}}
{{--                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
{{--                                        @error('slider_media')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputPassword1">Status</label>--}}
{{--                                        <select name="status" id="" class="form-control">--}}
{{--                                            <option value="1">Active</option>--}}
{{--                                            <option value="0">InActive</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                </div><!-- /.box-body -->--}}

{{--                                <div class="box-footer">--}}
{{--                                    <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div><!-- /.box -->--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--            </section><!-- /.content -->--}}
{{--        </aside><!-- /.right-side -->--}}
{{--    </div>--}}
    <!-- ./wrapper -->
@endsection
