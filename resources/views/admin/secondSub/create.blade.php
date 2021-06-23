@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Second Sub Category'
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
                                    <h3 class="card-title">Create Second Sub Category</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('secondsub.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Category Name</label>
                                        <input type="text" value="{{ old('secondary_subcategory_name') }}" name="secondary_subcategory_name" required autocomplete="off" class="form-control"  placeholder="Category Name">
                                        @error('secondary_subcategory_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="category_id">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Sub Category Name</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option selected>Select Sub Category</option>
{{--                                            @foreach($sub_categories as $category)--}}
{{--                                                <option value="{{$category->id}}">{{$category->subcategory_name}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                        @error('sub_category_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Category Status</label>
                                        <select name="status" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
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
@endsection
