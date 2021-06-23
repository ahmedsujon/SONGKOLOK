@extends('layouts.app_admin')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage EMI',
                'link' => route('emi.create'),
                'text' => 'Create EMI',
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
                                    <thead>

                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Duration</th>
                                        <th> Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($emis as $emi)
                                        <tr>
                                            <td class="text-center">{{$emi->bank_name}}</td>
                                            <td class="text-center">{{$emi->duration}}</td>
                                            <td class="text-center">
                                                <form action="{{ route('emi.change.status') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="{{$emi->status}}">
                                                    <input type="hidden" name="id" value="{{$emi->id}}">

                                                    @if($emi->status == 1)
                                                        <button type="submit" class="btn btn-success">Active</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td class="text-center">{{  \Carbon\Carbon::parse($emi->created_at)->format('M d Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('emi.edit', $emi->id) }}" class="btn btn-app float-left">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$emi->id}}">
                                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                                </a>

                                                <div class="modal fade" id="exampleModal{{$emi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('emi.destroy',$emi->id)}}" method="post">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button class="btn btn-danger">Confirm</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Duration</th>
                                        <th> Status</th>
                                        <th>Date</th>
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
