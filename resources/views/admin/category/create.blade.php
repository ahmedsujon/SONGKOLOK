@extends('layouts.app_admin')

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create Category'
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
                        <form role="form" action="{{route('category.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group col-md-6 float-left">
                                    <label for="exampleInputPassword1">Category Name</label>
                                    <input type="text" name="category_name" value="{{ old('category_name') }}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Category Name">
                                    @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label for="exampleInputPassword1">Category Status</label>
                                    <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label for="exampleInputFile">Category Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="category_image" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label for="exampleInputPassword1">Is Featured ?</label>
                                    <select name="featured" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                        <option value="1">Featured</option>
                                        <option value="0">Non featured</option>
                                    </select>
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
