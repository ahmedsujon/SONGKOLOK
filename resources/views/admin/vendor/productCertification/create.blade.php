@extends('layouts.app_admin')

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create Product Certification'
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
                                <h3 class="card-title">Create Product Certification</h3>
                            </div>
                            <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('productCertification.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                    <input type="text" value="{{old('name')}}" name="name" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Product Certification Name">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Issued By  </label>
                                    <input type="text" name="issued_by" required value="{{ old('issued_by') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="">
{{--                                    <textarea class="form-control" name="issued_by" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                                    @error('issued_by')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Business scope</label>
                                    <input type="text" name="business_scope" required value="{{ old('business_scope') }}" autocomplete="off" class="form-control" id="exampleInputPassword1">
{{--                                    <textarea class="form-control" name="description" require ="require" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
                                    @error('business_scope')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 float-left">
                                        <label for="exampleFormControlFile1">Certificate</label>
<!--                                        <input type="file" name="pdf" class="form-control-file" id="exampleFormControlFile1"> -->
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" name="pdf"  class="custom-file-input" id="exampleInputFile">
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
        <!-- /.content -->
@endsection
