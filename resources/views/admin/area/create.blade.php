@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Product Delivery Area'
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
                                    <h3 class="card-title">Upload Product Delivery Area</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('area.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">

{{--                                    <div class="form-group col-md-6 float-left">--}}
{{--                                        <label for="exampleInputPassword1">Product Name</label>--}}
{{--                                        <select  name="product_id" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">--}}
{{--                                            <option selected>Select Product</option>--}}
{{--                                            @foreach($products as $product)--}}
{{--                                                <option value="{{$product->id}}">{{$product->product_name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('product_id')--}}
{{--                                            <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Area</label>
                                        <input type="text" name="area_name" value="{{old('area_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Product Name">
                                        @error('area_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Delivery Charge</label>
                                        <input type="text" name="price" value="{{ old('price') }}" required autocomplete="off" class="form-control" id="exampleInputPassword1">
                                        @error('price')
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
