@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Coupon'
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
                                    <h3 class="card-title">Edit Coupon</h3>
                                </div>
                                <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('coupon.update',$coupon->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group float-left col-md-6">
                                    <label for="exampleInputPassword1">Coupon Code</label>
                                    <input type="text" name="coupon_code" require="require" autocomplete="off" value="{{$coupon->coupon_code}}" class="form-control"  placeholder="Coupon Code">
                                    @error('coupon_code')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group float-left col-md-6">
                                    <label >Coupon Amount</label>
                                    <input type="text" name="amount" require="require" autocomplete="off" class="form-control" value="{{$coupon->amount}}" placeholder="Coupon Amount">
                                    @error('amount')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group float-left col-md-6">
                                    <label for="exampleInputPassword1">Coupon Status</label>
                                    <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                        <option value="1" @if($coupon->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($coupon->status == 0) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group float-left col-md-6 mt-2">
                                    <label for=""> </label>
                                    <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>
                                </div>
                            </div><!-- /.box-body -->

{{--                            <div class="card-footer">--}}
{{--                                <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>--}}
{{--                            </div>--}}
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
