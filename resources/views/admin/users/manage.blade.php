@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'All Users'
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
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>Register date</th>
                                        <th>Active status</th>
                                        <th>Total orders</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $index => $user)
                                            <tr>
                                                <td>{{ $index+1}}</td>
                                                <td>{{$user->fname . ' ' . $user->lname}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td> {{ date('Y/m/d', strtotime($user->created_at)) }}</td>
                                                <td>
                                                    @if($user->is_verified == 1)
                                                        <a href="{{ route('admin.all.users.change.status', [$user->id, $user->is_verified]) }}" class="btn btn-app bg-success">
                                                            <i class="fas fa-users"></i> Active
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.all.users.change.status', [$user->id, $user->is_verified]) }}" class="btn btn-app bg-danger">
                                                            <i class="fas fa-user-times"></i> Inactive
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-danger">{{$user->orders->count()}}</td>

                                            </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
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

