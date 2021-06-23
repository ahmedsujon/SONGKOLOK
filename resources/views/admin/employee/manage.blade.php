@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Employee',
                'link' => route('employee.create'),
                'text' => "Create Employee"
            ])

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr class="">
                                        <th>Employee Id</th>
                                        <th>Image</th>
                                        <th>Employee Name</th>
                                        <th>Employee Email</th>
                                        <th>Employee Phone</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( ! empty($employees) )
                                        @foreach($employees as $index => $employee)
                                            <tr>
                                                <td class="">{{$employee['employee_unique_id']}}</td>
                                                <td>
                                                    <img src="{{assetImageAndVideo('images') . $employee->employee_image}}" alt="{{$employee->name}}" class="img-rounded" width="80">
                                                </td>
                                                <td>{{$employee->name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                <td>{{$employee->designation->designation_name}}</td>
                                                <td>
                                                    <form action="{{ route('employee.change.status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="{{$employee->status}}">
                                                        <input type="hidden" name="id" value="{{$employee->id}}">

                                                        @if($employee->status == 1)
                                                            <button type="submit" class="btn btn-success">Active</button>
                                                        @else
                                                            <button type="submit" class="btn btn-danger">Inactive</button>
                                                        @endif
                                                    </form>

                                                </td>
                                                <td>{{\Carbon\Carbon::parse($employee->created_at)->format('M d Y')}}</td>
                                                <td>
                                                    <a href="{{route('employee.edit',$employee->id)}}" class="btn text-warning btn-app float-left">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{route('employee.destroy',$employee->id)}}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="btn btn-app text-danger float-left" type="submit">
                                                            <i class="fa fa-trash fa-2x"></i> DELETE
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="">Employee Id</th>
                                        <th>Image</th>
                                        <th>Employee Name</th>
                                        <th>Employee Email</th>
                                        <th>Employee Phone</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
