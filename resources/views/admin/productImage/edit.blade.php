@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Product Image'
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
                                    <h3 class="card-title">Edit Product Image</h3>
                                </div>
                                <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('productImage.update',$productImage->id)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Product Name</label>
                                        <select name="product_id" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option selected="selected">Select Product</option>
                                            @foreach($products as $product)
                                                <option
                                                @if( $product->id == $productImage->productImages[0]->product_id )
                                                    selected
                                                @endif

                                                 value="{{$product->id}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach($productImage->productImages as $images)
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Product Image</label>
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" value="{{$images->product_image}}" name="product_image[]" multiple class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>

                                            <input type="hidden" name="product_image_id[]" value="{{$images->id}}">
                                            <span><img src="{{assetImageAndVideo('images').$images->product_image}}" alt="" width="80"></span>


                                    </div>
                                    @endforeach
                                </div><!-- /.box-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
