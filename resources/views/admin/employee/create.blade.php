@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Create Employee '
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
                                    <h3 class="card-title">Create Employee</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{route('employee.store')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Employee Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Employee Name">
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Employee Email</label>
                                            <input type="email" name="email" required value="{{ old('email') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Employee Email">
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Employee Contact</label>
                                            <input type="tel" name="phone" required value="{{ old('phone') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Employee Phone">
                                            @error('phone')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Employee Address</label>
                                            <input type="text" name="address" required value="{{ old('address') }}" autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Employee Address">
                                            @error('address')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Designation</label>
                                            <select name="designation_name" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option selected>Select Designation</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                                @endforeach
                                            </select>

                                            @error('designation_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Employee Status</label>
                                            <select name="status" id="" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>

                                            @error('status')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleFormControlFile1">Employee Image</label>
    {{--                                        <input type="file" name="sub_category_image" class="form-control-file" id="exampleFormControlFile1">--}}
                                            <div class="input-group ">
                                                <div class="custom-file">
                                                    <input type="file" name="employee_image"  class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @error('employee_image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for=""></label>
                                            <button type="submit" class="btn btn-outline-dark btn-block mt-2">Submit</button>
                                        </div>

                                    </div><!-- /.box-body -->

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
