@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Product'
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
                                    <h3 class="card-title">Create Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="col-md-12 card">
                                    <form  action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 float-left">
                                                    <label for="productIs">Product Status</label>
                                                    <select name="is_new" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                        <option>Select</option>
                                                        <option  value="1">Brand New</option>
                                                        <option value="2">Used</option>
                                                    </select>
                                                </div>



                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Name</label>
                                                    <input type="text" name="product_name" value="{{old('product_name')}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Product Name">
                                                    @error('product_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Brand</label>
                                                    <select required name="product_brand"  class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                        <option value="" >Select Brand</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{$brand->id}}" @if( old('product_brand') == $brand->id ) selected @endif >{{$brand->brand_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('product_brand')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Category</label>
                                                    <select required name="product_category" id="category_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        <option value="" >Select Category</option>
                                                        @foreach($categories as $category )
                                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_category')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group col-md-6 float-left">
                                                    <label for="">Sub Category</label>

                                                    <select required name="product_sub_category" id="sub_category_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                        <option  value="">Select Sub Category</option>
                                                    </select>
                                                    @error('product_sub_category')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="secondary_sub_categories_id">Second Sub Category</label>

                                                    <select name="secondary_sub_categories_id" id="secondary_sub_categories_id" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                        <option value="">Select Second Sub Category</option>
                                                    </select>

                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Coupon</label>
                                                    <select name="product_coupon" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                        <option value="" selected>Select Coupon</option>
                                                        @foreach($coupons as $coupon )
                                                            <option value="{{$coupon->id}}">{{$coupon->coupon_code}}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('product_coupon')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group col-md-6 float-left">
                                                    <label for="">Select Bank Names (multiple)</label>
                                                    <select name="emi_id[]" class="form-control select2 select2-success" multiple="multiple" data-placeholder="Select Bank Names" style="width: 100%;">
                                                        @foreach($emis as $emi)
                                                            <option value="{{$emi->id}}" selected>{{$emi->bank_name}} ({{$emi->duration}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Stock</label>
                                                    <input type="text" name="product_stock" value="{{ old('product_stock') }}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Product available">
                                                    @error('product_stock')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Model</label>
                                                    <input type="text" name="product_model" value="{{ old('product_model') }}"  autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Product Model">
                                                    @error('product_model')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Price</label>
                                                    <input type="text" name="product_price" value="{{ old('product_price') }}" required autocomplete="off" class="form-control" id="exampleInputPassword1">
                                                    @error('product_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Tax (%) </label>
                                                    <input type="text" value="{{ old('product_tax') }}" name="product_tax"  autocomplete="off" class="form-control" id="exampleInputPassword1">
                                                    @error('product_tax')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Manufacture</label>
                                                    <input type="text" name="manufactured_by"  value="{{ old('manufactured_by') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">
                                                    @error('manufactured_by')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleInputPassword1">Product Color</label>
                                                    <input type="text" name="product_color"  value="{{ old('product_color') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">
                                                    @error('product_color')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleSelectRounded0">Status</label>
                                                    <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                                        <option selected value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>



                                                <div class="form-group col-md-6 float-left">
                                                    <label for="exampleFormControlFile1">Product Feature Image</label>
                                                <!-- {{--                                            <input type="file" name="feature_image" class="form-control-file" id="exampleFormControlFile1">--}} -->
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="feature_image" class="custom-file-input" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 float-left">
                                                    <label for="return_policy">Return Policy</label>
                                                    <input type="text" value="{{old('return_policy')}}" name="return_policy" id="return_policy" placeholder="Exm: 12 days return" class="form-control" />
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label >Product Description</label>
                                                    <textarea class="form-control" name="product_description"  rows="10">{{ old('product_description') }}</textarea>
                                                    @error('product_description')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

{{--                                                <div class="form-group col-md-12">--}}
{{--                                                    <label >Product Description</label>--}}
{{--                                                    <textarea class="form-control" name="product_specification"  rows="10">{{ old('product_specification') }}</textarea>--}}
{{--                                                    @error('product_specification')--}}
{{--                                                    <span class="text-danger">{{$message}}</span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
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
        </div>
        </section>
        <!-- /.content -->
@endsection
