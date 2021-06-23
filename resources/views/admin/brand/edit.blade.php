@extends('layouts.app_admin')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Edit Brand'
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
                    <form role="form" action="{{route('brand.update',$brands->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">

                            <div class="form-group col-md-6 float-left">
                                <label for="exampleInputPassword1">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control" value="{{$brands->brand_name}}" placeholder="Brand Name">
                            </div>

                            <div class="form-group col-md-6 float-left">
                                <label for="exampleInputPassword1">Brand Status</label>
                                <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                    <option value="1" @if($brands->status == 1 ) selected @endif>Active</option>
                                    <option value="0" @if($brands->status == 0 ) selected @endif>InActive</option>
                                </select>
                            </div>

                        <div class="form-group col-md-6 float-left">
                            <label for="exampleInputPassword1">Brand Level</label>
                            <select name="level" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                <option value="1" @if($brands->level == 1 ) selected @endif>Top</option>
                                <option value="2" @if($brands->level == 2 ) selected @endif>Mid</option>
                                <option value="3" @if($brands->level == 3 ) selected @endif>Low</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6 float-left">
                            <label for="exampleFormControlFile1">Brand Logo</label>
                            {{--                                            <input type="file" name="feature_image" class="form-control-file" id="exampleFormControlFile1">--}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="brand_image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            <span><img src="{{assetImageAndVideo('images') .$brands->brand_image }}" alt="{{$brands->brand_name}}" width="80"></span>
                        </div>

{{--                        <div class="form-group col-md-6 float-left mt-2">--}}
{{--                            <label for="exampleFormControlFile1"> </label>--}}
{{--                            <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>--}}
{{--                        </div>--}}

                    </div><!-- /.box-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-outline-dark">Save Change</button>
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
        <!-- /.content -->
    </div>
        <!-- /.content -->
@endsection
