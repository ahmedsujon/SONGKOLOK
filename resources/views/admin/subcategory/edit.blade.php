@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Sub Category'
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
                                    <h3 class="card-title">Edit Sub Category</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                            <form role="form" action="{{route('subcategory.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Sub Category Name</label>
                                        <input type="text" name="subcategory_name" class="form-control" value="{{$subcategory->subcategory_name}}" placeholder="Brand Name">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Category Name</label>
                                        <select name="category_name" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($categories as $category)
                                                <option

                                                    @if( $category->id == $subcategory->category_id )
                                                        selected
                                                    @endif

                                                    value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Category Status</label>
                                        <select name="status" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option value="1" @if($subcategory->status == 1 ) selected @endif>Active</option>
                                            <option value="0" @if($subcategory->status == 0 ) selected @endif>InActive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Category Image</label>
{{--                                        <input type="file" name="sub_category_image" class="form-control-file" id="exampleFormControlFile1">--}}
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="sub_category_image" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        <span><img src="{{assetImageAndVideo('images').$subcategory->sub_category_image}}" alt="{{$category->subcategory_name}}" width="80"></span>
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
@endsection

