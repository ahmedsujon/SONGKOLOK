@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Delivery Area (Sub City)'
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
                                    <h3 class="card-title">Edit Delivery Area (Sub City)</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('subCity.update',$subCity->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Division</label>
                                        <select name="division_id" id="division_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($divisions as $division)
                                                <option

                                                    @if( $division->id == $subCity->division_id )
                                                    selected
                                                    @endif

                                                    value="{{$division->id}}">{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">District</label>
                                        <select name="district_id" id="district_id" data-placeholder="Select District" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($districts as $district)
                                                <option

                                                    @if( $district->id == $subCity->district_id )
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
                                        <label for="exampleInputPassword1">District</label>
                                        <select name="city_id" id="city_id" data-placeholder="Select City" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($cities as $city)
                                                <option

                                                    @if( $city->id == $subCity->city_id )
                                                    selected
                                                    @endif

                                                    value="{{$city->id}}">{{$city->city_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Sub City</label>
                                        <input type="text" name="sub_city_name" value="{{$subCity->sub_city_name}}" required autocomplete="off" class="form-control" id="exampleInputPassword1">
                                        @error('sub_city_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


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
