@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Delivery Area (Sub City)'
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
                                    <h3 class="card-title">Upload Delivery Area (Sub City)</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{route('subCity.store')}}" enctype="multipart/form-data" method="POST">
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
                                            <select name="district_id" id="district_id" data-placeholder="Select District" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option value="">Select District</option>
                                            </select>
                                            @error('district_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">City</label>
                                            <select name="city_id" id="city_id" data-placeholder="Select City" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option value="">Select City</option>
                                            </select>
                                            @error('city_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Sub City</label>
                                            <input type="text" name="sub_city_name" value="{{old('sub_city_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Sub City Name">
                                            @error('sub_city_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
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
