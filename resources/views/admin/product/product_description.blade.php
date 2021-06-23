@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Add Specification'
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
                                    <h3 class="card-title">Add Specification</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="col-md-12 card">
                                    @if($product)
                                        <form  action="{{route('product.update.menual.post', $product->id)}}"  method="POST">
                                        @csrf
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label >Product Specification</label>
                                                    <textarea class="form-control" name="product_specification"  rows="10">{{ $product->product_specification }}</textarea>
                                                    @error('product_specification')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
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
                </div>
            </section>
            <!-- /.content -->
@endsection
