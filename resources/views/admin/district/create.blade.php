@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Delivery Area (District)'
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
                                    <h3 class="card-title">Upload Delivery Area (District)</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('district.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1"> Division</label>
                                        <select name="division_id"  class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option selected>Select Division</option>
                                            @foreach($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">District</label>
                                        <input type="text" name="district_name" value="{{old('district_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="District Name">
                                        @error('district_name')
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
{{--                                    <div class="form-group col-md-6 float-left">--}}
{{--                                        <label for="exampleInputPassword1">Delivery Charge</label>--}}
{{--                                        <input type="text" name="price" value="{{ old('price') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">--}}
{{--                                        @error('price')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
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
