@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Product Delivery Area (Division)'
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
                                    <h3 class="card-title">Upload Product Delivery Area (Division)</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('division.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Division</label>
                                        <input type="text" name="division_name" value="{{old('division_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Division Name">
                                        @error('division_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

{{--                                    <div class="form-group col-md-6 float-left">--}}
{{--                                        <label for="exampleInputPassword1">Zip Code</label>--}}
{{--                                        <input type="text" name="zip_code" value="{{ old('zip_code') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">--}}
{{--                                        @error('zip_code')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Delivery Charge</label>
                                        <input type="text" name="price" value="{{ old('price') }}"  class="form-control" id="exampleInputPassword1">

                                    </div>
                                </div><!-- /.box-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
                                </div>
                            </form>
                                <!-- /.card -->

                            </div>
                            <!--/.col (left) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            </section>
            <!-- /.content -->
@endsection
