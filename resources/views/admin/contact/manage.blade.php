@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Slider',
                'link' => route("contactusslider.create"),
                'text' => "Create Slider"
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
                                        <th>Slider For</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sliders as $index => $slider)
                                        <tr>
                                            <td>
                                                @if( $slider->for == 1 )
                                                    {{__('Home')}}
                                                @elseif($slider->for == 2)
                                                    {{__('Vendor')}}
                                                 @else
                                                        {{__('Contact Us')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($slider->type != 'video')
                                                    <img src="{{assetImageAndVideo('images').$slider->slider_media}}" alt="" class="img-rounded" width="80" />
                                                @else
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item" src="{{assetImageAndVideo('videos').$slider->slider_media}}" allowfullscreen></iframe>
                                                    </div>
{{--                                                    <video width="320" height="200" controls>--}}
{{--                                                        <source src="{{url('videos',$slider->slider_media)}}" type="video/{{$slider->file_type}}">--}}
{{--                                                        Your browser does not support the video .--}}
{{--                                                    </video>--}}
{{--                                                    <video src="{{url('videos',$slider->slider_media)}}"></video>--}}
                                                @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('contactusslider.update', $slider->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{$slider->status}}">
                                                    <input type="hidden" name="id" value="{{$slider->id}}">

                                                    @if($slider->status == 1)
                                                        <button type="submit" class="btn btn-success">Active</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                                    @endif
                                                </form>
                                            </td>

                                            <td>{{\Carbon\Carbon::parse($slider->created_at)->format('M d Y')}}</td>
                                            <td>
                                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$slider->id}}">
                                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$slider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('contactusslider.destroy',$slider->id)}}" method="post">
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
                                        <th>Slider For</th>
                                        <th>File</th>
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
