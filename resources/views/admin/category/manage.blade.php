@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
        'title' => 'Manage Category',
        'link' => route('category.create'),
        'text' => 'Create Category',
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
                                            <th>Category Image</th>
                                            <th>Category Name</th>
                                            <th>Category Status</th>
                                            <th>Create Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                        @foreach($categorys as $index => $category)
                        <tr>
                            <td>
                                <img src="{{assetImageAndVideo('images').$category->category_image}}" alt="{{$category->category_name}}" class="img-rounded" width="80" />
                            </td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <form action="{{ route('category.change.status') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="status" value="{{$category->status}}">
                                    <input type="hidden" name="id" value="{{$category->id}}">

                                    @if($category->status == 1)
                                        <button type="submit" class="btn btn-success">Active</button>
                                    @else
                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                    @endif
                                </form>
                            </td>

                            <td>{{\Carbon\Carbon::parse($category->created_at)->format('M d Y')}}</td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn text-warning btn-app float-left">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('category.destroy',$category->id)}}" method="post">
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
                                        <th>Category Image</th>
                                        <th>Category Name</th>
                                        <th>Category Status</th>
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
