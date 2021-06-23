@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Employee'
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
                                    <h3 class="card-title">Edit Employee</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                            <form role="form" action="{{route('employee.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Employee Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$employee->name}}">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Employee Email</label>
                                        <input type="email" name="email" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$employee->email}}">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Employee Contact</label>
                                        <input type="tel" name="phone" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$employee->phone}}">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Employee Address</label>
                                        <input type="text" name="address" require="require" autocomplete="off" class="form-control" id="exampleInputPassword1" value="{{$employee->address}}">
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Designation</label>
                                        <select name="designation_name" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            @foreach($designations as $designation)
                                                <option

                                                    @if( $designation->id == $employee->designation_id )
                                                        selected
                                                    @endif

                                                    value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleInputPassword1">Employee Status</label>
                                        <select name="status" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                            <option value="1" @if($employee->status == 1 ) selected @endif>Active</option>
                                            <option value="0" @if($employee->status == 0 ) selected @endif>InActive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 float-left">
                                        <label for="exampleFormControlFile1">Employee Image</label>
{{--                                        <input type="file" name="sub_category_image" class="form-control-file" id="exampleFormControlFile1">--}}
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="employee_image" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        <span><img src="{{assetImageAndVideo('images').$employee->employee_image}}" alt="{{$employee->name}}" width="80"></span>
                                    </div>

                                    <div class="form-group mt-2 col-md-6 float-left">
                                        <label > </label>
                                        <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>
                                    </div>
                                </div><!-- /.box-body -->

{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-outline-dark btn-block">Save Change</button>--}}
{{--                                </div>--}}
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

