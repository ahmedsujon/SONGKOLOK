@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Upload Product Images'
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
                                    <h3 class="card-title">Upload Product Images</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('productImage.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Product Name</label>
                                        <select  name="product_name" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option selected>Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('product_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Product Image (upload multiple) </label>
{{--                                        <input multiple type="file" name="product_image[]" class="form-control-file" id="exampleFormControlFile1">--}}
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" name="product_image[]" multiple class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
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
