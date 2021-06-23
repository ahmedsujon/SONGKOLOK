@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Coupon'
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
                                    <h3 class="card-title">Create Category</h3>
                                </div>
                                <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('coupon.store')}}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group float-left col-md-6">
                                    <label for="exampleInputPassword1">Coupon Code</label>
                                    <input type="text" name="coupon_code" value="{{ old('coupon_code') }}" required autocomplete="off" class="form-control"  placeholder="Coupon Code">
                                    @error('coupon_code')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group float-left col-md-6">
                                    <label >Coupon Amount</label>
                                    <input type="text" name="amount" value="{{ old('amount') }}" required autocomplete="off" class="form-control"  placeholder="Coupon Amount">
                                    @error('amount')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="exampleSelectRounded0">Status</label>
                                    <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 float-left mt-2">
                                    <label for=""> </label>
                                    <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
                                </div>

                            </div><!-- /.box-body -->

{{--                            <div class="card-footer">--}}
{{--                                <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>--}}
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
