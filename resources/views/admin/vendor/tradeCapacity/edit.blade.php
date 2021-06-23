@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Product Trade Capacity'
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
                                    <h3 class="card-title">Edit Product Trade Capacity</h3>
                                </div>
                                <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('tradeCapacity.update',$tradeCapacity->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Main Markets</label>
                                    <input type="text" name="main_markets" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$tradeCapacity->main_markets}}">

                                </div>

                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Total Revenue</label>
                                    <input type="text" name="total_revenue" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$tradeCapacity->total_revenue}}">
                                    {{--                                    <textarea class="form-control" name="issued_by" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}

                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Main Products</label>
                                    <input type="text" name="main_product" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$tradeCapacity->main_product}}">
                                    {{--                                    <textarea class="form-control" name="description" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                                </div>

                            </div><!-- /.box-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>
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
