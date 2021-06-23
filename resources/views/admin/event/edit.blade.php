@extends('layouts.app_admin')

@section('content')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        @include('layouts.admin_blade_title', [
                'title' => 'Edit Event'
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
                                    <h3 class="card-title">Edit Event</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="{{route('event.update',$event->id)}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Event Name</label>
                                            <input type="text" name="event_name" value="{{ $event->event_name}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="Event Name">
                                            @error('event_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
{{--                                        <div class="form-group col-md-6 float-left">--}}
{{--                                            <label for="exampleInputPassword1">Event Discount</label>--}}
{{--                                            <input type="text" name="discount" value="{{ $event->discount}}" required autocomplete="off" class="form-control" id="exampleInputPassword1" placeholder="40%">--}}
{{--                                            @error('discount')--}}
{{--                                            <span class="text-danger">{{$message}}</span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Event Status</label>
                                            <select name="status" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                <option value="1" @if($event->status == 1 ) selected @endif>Active</option>
                                                <option value="0" @if($event->status == 0 ) selected @endif>InActive</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Event Start Date</label>
                                            <input type="datetime-local" name="start_date" class="form-control" value="{{ date('m/d/Y H:i A', strtotime($event->start_date)) }}" />
                                            <span>{{\Carbon\Carbon::parse($event->start_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</span>
                                        </div>
                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputPassword1">Event End Date</label>
                                            <input type="datetime-local" name="end_date" class="form-control" value="{{ $event->end_date}}" />
                                            <span>{{\Carbon\Carbon::parse($event->end_date)->format('F j, Y,g:i:s a', time() - 6*3600)}}</span>
                                        </div>

                                        <div class="form-group col-md-6 float-left">
                                            <label for="exampleInputFile">Event Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="event_image" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <span>
                                                <img src="{{assetImageAndVideo('images').$event->event_image}}" alt="{{$event->event_name}}" class="img-rounded" width="80" />
                                            </span>
                                        </div>


                                    </div><!-- /.box-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>
                                    </div>
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
@endsection
