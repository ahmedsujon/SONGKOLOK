@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
        'title' => 'Manage Event',
        'link' => route('event.create'),
        'text' => 'Create Event',
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
                                            <th>SL</th>
                                            <th>Event Image</th>
                                            <th>Event Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Create Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                        @foreach($events as $index => $event)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>
                                <img src="{{assetImageAndVideo('images').$event->event_image}}" alt="{{$event->event_name}}" class="img-rounded" width="80" />
                            </td>
                            <td>{{$event->event_name}}</td>
                            <td>{{\Carbon\Carbon::parse($event->start_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</td>
                            <td>{{\Carbon\Carbon::parse($event->end_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</td>
                            <td>
                                <form action="{{ route('event.change.status') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="status" value="{{$event->status}}">
                                    <input type="hidden" name="id" value="{{$event->id}}">

                                    @if($event->status == 1)
                                        <button type="submit" class="btn btn-success">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                    @endif
                                </form>
                            </td>

                            <td>{{\Carbon\Carbon::parse($event->created_at)->format('M d Y')}}</td>
                            <td>
                                <a href="{{route('event.edit',$event->id)}}" class="btn text-warning btn-app">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$event->id}}">
                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('event.destroy',$event->id)}}" method="post">
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
                                        <th>SL</th>
                                        <th>Event Image</th>
                                        <th>Event Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
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
