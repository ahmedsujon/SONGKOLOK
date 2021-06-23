@extends('layouts.app_admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Brand'
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
                            <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputEmail1">Brand Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name" value="{{ old('brand_name') }}" placeholder="Enter Brand Name" required />

                                        @error('brand_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleSelectRounded0">Brand Status</label>
                                        <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleSelectRounded0">Brand Level</label>
                                        <select name="level" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                            <option value="1">Top</option>
                                            <option value="2">Mid</option>
                                            <option value="3">Low</option>
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
                                    </div>
                                </div>
{{--                                    <div class="form-group col-md-6 float-left mt-2">--}}
{{--                                        <label for="exampleFormControlFile1"> </label>--}}
{{--                                        <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>--}}
{{--                                    </div>--}}
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
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

@endsection
