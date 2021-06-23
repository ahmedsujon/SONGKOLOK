@extends('layouts.app_admin')

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create Product Quality'
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
                                <h3 class="card-title">Create Product Quality</h3>
                            </div>
                            <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('productQuality.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Quality Title</label>
                                    <input type="text" value="{{ old('title') }}" name="title" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Product Capacity Title">
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Product Quality Description</label>
                                    <textarea class="form-control" name="description" required  id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Product Quality Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="quality_image" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    @error('quality_image')
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
