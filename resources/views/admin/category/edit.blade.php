@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Category'
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
                                    <h3 class="card-title">Edit Category</h3>
                                </div>
                                <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="card-body">
                                <div class="form-group float-left col-md-6">
                                    <label for="exampleInputPassword1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}" placeholder="Brand Name">
                                </div>
                                <div class="form-group float-left col-md-6">
                                    <label for="exampleInputPassword1">Category Status</label>
                                    <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                    <option value="1" @if($category->status == 1 ) selected @endif>Active</option>
                                        <option value="0" @if($category->status == 0 ) selected @endif>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group float-left col-md-6">
                                    <label for="exampleFormControlFile1">Category Image</label>
{{--                                    <input type="file" name="category_image" class="form-control-file" id="exampleFormControlFile1">--}}
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="category_image" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>

                                    <span><img src="{{assetImageAndVideo('images').$category->category_image}}" alt="{{$category->category_name}}" width="80"></span>
                                </div>


                            <div class="form-group col-md-6 float-left">
                                <label for="exampleInputPassword1">Is Featured ?</label>
                                <select name="featured" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                    <option value="1" @if( $category->featured == 1 ) selected @endif >Featured</option>
                                    <option value="0" @if( $category->featured == 0 ) selected @endif >Non featured</option>
                                </select>
                            </div>

{{--                            <div class="form-group float-left col-md-6 mt-2">--}}
{{--                                <label for="exampleInputPassword1"></label>--}}
{{--                                <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>--}}
{{--                            </div>--}}

                            </div>
                            <!-- /.box-body -->

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
