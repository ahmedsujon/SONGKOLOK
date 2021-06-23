@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Blog'
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
                                            <th>User Name</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Post</th>
                                            <th>Approved</th>
                                            <th>Create Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                        @foreach($blogs as $index => $blog)
                        <tr>
                            <td>{{$blog->user->fname}} {{$blog->user->lname}}</td>
                            <td>{{$blog->title}} </td>
                            <td>
                                <iframe width="315" height="315" src="{{ $blog->blog_video }}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </td>
                            <td>{!! $blog->post !!}</td>
                            <td>
                                <form action="{{ route('blog.change.status') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="status" value="{{$blog->status}}">
                                    <input type="hidden" name="id" value="{{$blog->id}}">

                                    @if($blog->status == 1)
                                        <button type="submit" class="btn btn-success">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                    @endif
                                </form>
                            </td>

                            <td>{{\Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}</td>
                            <td>
                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$blog->id}}">
                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$blog->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('blog.destroy',$blog->id)}}" method="post">
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
                                        <th>User Name</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Post</th>
                                        <th>Approved</th>
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
