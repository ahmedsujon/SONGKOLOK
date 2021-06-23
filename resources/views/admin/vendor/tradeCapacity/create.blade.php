@extends('layouts.app_admin')

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create Product Trade Capacity'
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
                                <h3 class="card-title">Create Product trade Capacity</h3>
                            </div>
                            <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('tradeCapacity.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Main Markets</label>
                                    <input type="text" name="main_markets" required value="{{ old('main_markets') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Main Market">
                                    @error('main_markets')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Total Revenue</label>
                                    <input type="text" name="total_revenue" required value="{{ old('total_revenue') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="">
{{--                                    <textarea class="form-control" name="issued_by" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                                    @error('total_revenue')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Main Product</label>
                                    <input type="text" name="main_product" required value="{{ old('main_product') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">
{{--                                    <textarea class="form-control" name="description" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                                    @error('main_product')
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
        <!-- /.content -->
@endsection
