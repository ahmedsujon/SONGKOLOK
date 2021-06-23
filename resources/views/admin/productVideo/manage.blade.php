@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Product Videos',
                'link' => route('productVideo.create'),
                'text' => "Upload Product Video"
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
                            <th>Product Video</th>
                            <th>Product Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($productvideos) > 0 )
                            @foreach($productvideos as $index => $productvideo)
                                <tr>
                                    <td>
{{--                                        <video width="320" height="200" controls>--}}
{{--                                            <source src="{{assetImageAndVideo('videos').$productvideo->product_video}}" type="video/{{$productvideo->product_video_type}}">--}}
{{--                                            Your browser does not support the video .--}}
{{--                                        </video>--}}
                                        {!! $productvideo->product_video !!}
                                    </td>
                                    <td>{{$productvideo->product->product_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($productvideo->created_at)->format('M d Y')}}</td>
                                    <td>
                                        <a href="{{route('productVideo.edit',$productvideo->id)}}" class="btn text-warning btn-app float-left">
                                            <i class="fas fa-edit"></i> Edit</a>
                                        <a href="" class="btn btn-app text-danger " data-toggle="modal" data-target="#exampleModal{{$productvideo->id}}">
                                            <i class="fa fa-trash fa-2x"></i> DELETE
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$productvideo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete !!!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('productVideo.destroy',$productvideo->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
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
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Product Video</th>
                            <th>Product Name</th>
                            <th>Created At</th>
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
