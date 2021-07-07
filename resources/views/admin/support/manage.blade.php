@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Contact Message'
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
                                    <thead >
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                        @foreach($supports as $index => $support)
                        <tr>
                            <td>{{ $support->name }}</td>
                            <td>{{ $support->email }}</td>
                            <td>{{ $support->phone }}</td>
                            <td>{{ $support->subject }}</td>
                            <td>{!! $support->description !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
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
