@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'All Vendor'
            ])



    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">

                                    <thead style="background-color: #000;color:#fff">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Register date</th>
                                        <th>Active status</th>
                                        <th>Total orders</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $index => $vendor)
                                            <tr>
                                                <td>{{ $index+1}}</td>
                                                <td>{{$vendor->name}}</td>
                                                <td>{{$vendor->email}}</td>
                                                <td> {{ date('Y/m/d', strtotime($vendor->created_at)) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('vendor.change.status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="{{$vendor->status}}">
                                                        <input type="hidden" name="id" value="{{$vendor->id}}">

                                                        @if($vendor->status == 1)
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-users"></i>   Active</button>
                                                        @else
                                                            <button type="submit" class="btn btn-danger"><i class="fas fa-users"></i>   Inactive</button>
                                                        @endif
                                                    </form>
                                                </td>
                                                <td class="text-danger">{{$vendor->orders->count()}}</td>

                                            </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Register date</th>
                                        <th>Active status</th>
                                        <th>Total orders</th>
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

