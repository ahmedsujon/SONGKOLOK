@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Sub Category'
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
                                    <h3 class="card-title">Create Sub Category</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('subcategory.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Sub Category Name</label>
                                        <input type="text" name="subcategory_name" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Sub Category Name">
                                        @error('subcategory_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Category Name</label>
                                        <select name="category_name" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Sub Category Status</label>
                                        <select name="status" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">

                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Sub Category Image</label>
{{--                                        <input type="file" name="sub_category_image" class="form-control-file" id="exampleFormControlFile1">--}}
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" name="sub_category_image"  class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
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
