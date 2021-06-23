@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Delivery Area (City)'
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
                                    <h3 class="card-title">Upload Delivery Area (City)</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{route('city.store')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1"> Division</label>
                                            <select name="division_id" id="division_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option selected>Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{$division->id}}">{{$division->division_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">District</label>
                                            <select name="district_id" id="district_id" data-placeholder="Select Products" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option value="">Select District</option>
                                            </select>
                                            @error('district_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">City</label>
                                            <input type="text" name="city_name" value="{{old('city_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="City Name">
                                            @error('city_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

{{--                                        <div class="form-group col-md-6 float-left">--}}
{{--                                            <label for="exampleInputPassword1">Zip Code</label>--}}
{{--                                            <input type="text" name="zip_code" value="{{ old('zip_code') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">--}}
{{--                                            @error('zip_code')--}}
{{--                                            <span class="text-danger">{{$message}}</span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 float-left">--}}
{{--                                            <label for="exampleInputPassword1">Delivery Charge</label>--}}
{{--                                            <input type="text" name="price" value="{{ old('price') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Not Mandatory ">--}}
{{--                                        </div>--}}
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
