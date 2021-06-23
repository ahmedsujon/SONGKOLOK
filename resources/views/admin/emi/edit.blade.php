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
                            @if( ! empty($emi) )
                                <form action="{{route('emi.update', $emi->id)}}" method="POST">
                                @csrf
                                    @method('PUT')
                                <div class="card-body">

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputEmail1">Bank Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="bank_name" value="{{ $emi->bank_name }}" placeholder="Enter Bank Name" required />

                                            @error('bank_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputEmail1">EMI duration</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="duration" value="{{ $emi->duration }}" placeholder="EMI duration" required />

                                            @error('duration')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleSelectRounded0">EMI Status</label>
                                            <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;" >
                                                <option value="1" @if( $emi->status == 1 ) selected @endif >Active</option>
                                                <option value="0" @if( $emi->status == 0 ) selected @endif >Inactive</option>
                                            </select>
                                        </div>


                                        <div class="form-group col-md-6 float-left mt-2">
                                            <label for="exampleSelectRounded0"></label>
                                            <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
                                        </div>




                                </div>

                                <!-- /.card-body -->

{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>--}}
{{--                                </div>--}}
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
        <!-- /.content -->
    </div>

@endsection
