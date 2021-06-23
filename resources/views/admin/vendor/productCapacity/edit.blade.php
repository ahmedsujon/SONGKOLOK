@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Product Capacity'
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
                                    <h3 class="card-title">Edit Product Capacity</h3>
                                </div>
                                <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('productCapacity.update',$productCapacity->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="card-body">
                            <div class="form-group col-md-6 float-left">
                                <label for="exampleInputPassword1">Product Capacity Title</label>
                                <input type="text" name="title" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$productCapacity->title}}">

                            </div>
                            <div class="form-group ">
                                <label for="exampleFormControlTextarea1">Product Capacity Description</label>
                                <textarea class="form-control" name="description" require ="require" id="exampleFormControlTextarea1" rows="3">{{$productCapacity->description}}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Product Capacity Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="capacity_image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                <span><img src="{{assetImageAndVideo('images').$productCapacity->capacity_image}}" alt="{{$productCapacity->title}}" width="80"></span>
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
