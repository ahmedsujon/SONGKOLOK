@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Delivery Area (City)'
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
                                    <h3 class="card-title">Edit Delivery Area (City)</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('city.update',$city->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Division</label>
                                        <select name="division_id" id="division_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($divisions as $division)
                                                <option

                                                    @if( $division->id == $city->division_id )
                                                    selected
                                                    @endif

                                                    value="{{$division->id}}">{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">District</label>
                                        <select name="district_id" id="district_id" data-placeholder="Select Products" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($districts as $district)
                                                <option

                                                    @if( $district->id == $city->district_id )
                                                    selected
                                                    @endif

                                                    value="{{$district->id}}">{{$district->district_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">City</label>
                                        <input type="text" name="city_name" value="{{$city->city_name}}" required autocomplete="off" class="form-control" id="exampleInputPassword1">
                                        @error('city_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

{{--                                    <div class="form-group col-md-6 float-left">--}}
{{--                                        <label for="exampleInputPassword1"> Zip Code</label>--}}
{{--                                        <input type="text" name="zip_code" value="{{$city->zip_code}}"  autocomplete="off" class="form-control" id="exampleInputPassword1">--}}
{{--                                        @error('zip_code')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-6 float-left">--}}
{{--                                        <label for="exampleInputPassword1">Delivery Charge</label>--}}
{{--                                        <input type="text" name="price" value="{{$city->price}}"  autocomplete="off" class="form-control" id="exampleInputPassword1">--}}
{{--                                        @error('price')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

                                </div><!-- /.box-body -->

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
@endsection
