@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Second SubCategory'
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
                                    <h3 class="card-title">Edit Second Sub Category</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                @if( ! empty($subcategory) )
                                    <form role="form" action="{{route('secondsub.update',$subcategory->id)}}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Category Name</label>
                                            <input type="text" name="secondary_subcategory_name" class="form-control" value="{{$subcategory->secondary_subcategory_name}}" placeholder="Brand Name">
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Category Name</label>
                                            <select name="category_id" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option selected>Select Category</option>
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
                                            <label for="exampleInputPassword1">Sub Category Name</label>
                                            <select name="sub_category_id" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option selected>Select Category</option>
                                                @foreach($sub_categories as $category)
                                                    <option value="{{$category->id}}"
                                                            @if( $category->id == $subcategory->category_id )
                                                            selected
                                                        @endif
                                                    >{{$category->subcategory_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Category Status</label>
                                            <select name="status" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option value="1" @if($subcategory->status == 1 ) selected @endif>Active</option>
                                                <option value="0" @if($subcategory->status == 0 ) selected @endif>InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>
                                    </div>
                                </form>
                                @endif
                            </div>
                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

            </section>
@endsection

