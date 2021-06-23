@extends('layouts.app_admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Create EMI'
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
                                <h3 class="card-title">Create EMI</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('emi.store')}}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div id="copy">
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputEmail1">Bank Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="bank_name[]" value="{{ old('bank_name') }}" placeholder="Enter Bank Name" required />

                                            @error('bank_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputEmail1">EMI duration</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="duration[]" value="{{ old('duration') }}" placeholder="EMI duration" required />

                                            @error('duration')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleSelectRounded0">EMI Status</label>
                                            <select name="status[]" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div id="others"></div>

                                    <div class="form-group ">
                                        {{--                                            <label for="exampleFormControlFile1"> </label>--}}
                                        <div class="btn-group " style="margin-top: 30px">
                                            <label for=""> </label>
                                            <button type="button" class="btn btn-success" id="add_button">Add</button>
                                            <button type="button" class="btn btn-danger" id="delete_button">Delete</button>
                                        </div>
                                    </div>


                                </div>

                            <!-- /.card-body -->

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
    </div>

@endsection
