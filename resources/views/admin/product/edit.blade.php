@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Product'
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
                                    <h3 class="card-title">Edit Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-md-6 float-left">
                                                <label for="productIs">Product Status</label>
                                                <select name="is_new" class="form-control select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;" >
                                                    <option value="">Select</option>
                                                    <option @if( $product->is_new == 1 ) selected @endif value="1">Brand New</option>
                                                    <option @if( $product->is_new == 2 ) selected @endif value="2">Used</option>
                                                </select>
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Name</label>
                                                <input type="text" name="product_name" class="form-control" id="exampleInputPassword1" value="{{$product->product_name}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Brand</label>
                                                <select name="product_brand" id="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="" selected disabled>Select Brand</option>
                                                    @foreach($brands as $brand)
                                                        <option

                                                            @if( $brand->id == $product->brand_id )
                                                            selected
                                                            @endif
                                                            value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Category</label>
                                                <select name="product_category" id="category_id"  class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="" selected disabled>Select </option>
                                                    @foreach($categories as $category )
                                                        <option

                                                            @if( $category->id == $product->category_id )
                                                            selected
                                                            @endif
                                                            value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 float-left">
                                                <label for="">Sub Category</label>

                                                <select name="product_sub_category" id="sub_category_id" data-subcat="{{ $product->sub_categories_id }}" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="" selected disabled>Select </option>
                                                    @foreach($subcategory as $scategory )
                                                        <option
                                                            @if( $scategory->id == $product->sub_categories_id )
                                                            selected
                                                            @endif
                                                            value="{{$scategory->id}}">{{$scategory->subcategory_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="form-group col-md-6 float-left">
                                                <label for="">Second Sub Category</label>

                                                <select name="secondary_sub_categories_id" id="secondary_sub_categories_id" data-secondsub="{{$product->secondary_sub_categories_id}}" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="">Select </option>
                                                    @foreach($secondary_sub as $category )
                                                        <option @if( $category->id == $product->secondary_sub_categories_id )
                                                                selected
                                                                @endif

                                                                value="{{$category->id}}">{{$category->secondary_subcategory_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Coupon</label>
                                                <select name="product_coupon" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <option value="" >Select</option>
                                                    @foreach($coupons as $coupon )
                                                        <option

                                                            @if( $coupon->id == $product->coupon_id )
                                                            selected
                                                            @endif

                                                            value="{{$coupon->id}}">{{$coupon->coupon_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6 float-left">
                                                <label for="">Select Bank Names (multiple)</label>
                                                <select name="emi_id[]" class="form-control select2 select2-success" multiple="multiple" data-placeholder="Select Bank Names" style="width: 100%;">
                                                    @php $emi_id = explode(',', $product->emi_id) @endphp
                                                    @foreach($emis as $emi)
                                                        {{ array_search($emi->id, $emi_id) }}
                                                        <option value="{{$emi->id}}" @if(is_numeric(array_search($emi->id, $emi_id) )) selected @endif>{{$emi->bank_name}} ({{$emi->duration}})</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Stock</label>
                                                <input type="text" name="product_stock" class="form-control" id="exampleInputPassword1" value="{{$product->stock}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Size</label>
                                                <input type="text" name="product_size" class="form-control" id="exampleInputPassword1" value="{{$product->size}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Model</label>
                                                <input type="text" name="product_model" class="form-control" id="exampleInputPassword1" value="{{$product->model}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Price</label>
                                                <input type="text" name="product_price" class="form-control" id="exampleInputPassword1" value="{{$product->product_price}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Tax</label>
                                                <input type="text" name="product_tax" class="form-control" id="exampleInputPassword1" value="{{$product->tax}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Manufacture</label>
                                                <input type="text" name="manufactured_by" class="form-control" id="exampleInputPassword1" value="{{$product->manufactured_by}}">
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleInputPassword1">Product Color</label>
                                                <input type="text" name="product_color" class="form-control" id="exampleInputPassword1" value="{{$product->color}}">
                                            </div>

                                            <div class="form-group col-md-6 float-left">
                                                <label for="exampleSelectRounded0">Status</label>
                                                <select name="status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" id="exampleSelectRounded0">
                                                    <option
                                                        @if( $product->status == 1 ) selected @endif
                                                    value="1">Active</option>
                                                    <option @if( $product->status == 0 ) selected @endif value="0">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="form-group float-left col-md-6">
                                                <label for="exampleFormControlFile1">Product Feature Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="feature_image" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <span><img src="{{assetImageAndVideo('images').$product->feature_image}}" alt="" width="80"></span>
                                            </div>

                                            <div class="form-group col-md-6 float-left">
                                                <label for="return_policy">Return Policy</label>
                                                <input type="text" value="{{$product->return_policy}}" name="return_policy" id="return_policy" placeholder="Exm: 12 days return" class="form-control" />
                                            </div>


                                        </div>


                                        <div class="row">
{{--                                            <div class="form-group col-md-12">--}}
{{--                                                <label>Product Specification</label>--}}
{{--                                                <textarea class="form-control" name="product_specification"   rows="3">{{ $product->specification }}</textarea>--}}
{{--                                            </div>--}}

                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlTextarea1">Product Description</label>
                                                <textarea class="form-control" name="product_description" rows="3">{{$product->product_description}}</textarea>
                                            </div>
                                        </div>




                                    </div>

                                    <div class="box-footer">
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
