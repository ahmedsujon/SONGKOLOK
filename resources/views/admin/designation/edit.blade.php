@extends('layouts.app_admin')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
            'title' => 'Edit Designation'
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
                                <h3 class="card-title">Update Designation</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                    <form role="form" action="{{route('designation.update',$designations->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="card-body">

                            <div class="form-group col-md-6 float-left">
                                <label for="exampleInputPassword1">Designation Name</label>
                                <input type="text" name="designation_name" class="form-control" value="{{$designations->designation_name}}" placeholder="Designation Name">
                            </div>

                        <div class="form-group col-md-6 float-left mt-2">
                            <label for=""> </label>
                            <button type="submit" class="btn btn-block btn-outline-dark">Save Change</button>
                        </div>

                    </div><!-- /.box-body -->

{{--                        <div class="card-footer">--}}
{{--                            <button type="submit" class="btn btn-block btn-outline-dark">Save Change</button>--}}
{{--                        </div>--}}
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
        <!-- /.content -->
@endsection
