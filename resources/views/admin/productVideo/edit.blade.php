@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Product Video'
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
                                    <h3 class="card-title">Edit Product Video</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                            <form role="form" action="{{route('productVideo.update',$productvideo->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Product Name</label>
                                        <select name="product_name" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            @foreach($products as $product)
                                                <option
                                                @if( $product->id == $productvideo->product_id )
                                                    selected
                                                @endif

                                                 value="{{$product->id}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Youtube Embaded video</label>

                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="text" name="product_video"  class="form-control" id="exampleInputFile">
{{--                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
                                            </div>
                                        </div>

{{--                                        <span>--}}
{{--                                            <video width="320" height="200" controls>--}}
{{--                                                <source src="{{assetImageAndVideo('videos').$productvideo->product_video}}" type="video/{{$productvideo->product_video_type}}">--}}
{{--                                                Your browser does not support the video .--}}
{{--                                            </video>--}}
{{--                                        </span>--}}

                                    </div>

                                </div><!-- /.box-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-dark btn-block">Save Changes</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

            </section>
@endsection
