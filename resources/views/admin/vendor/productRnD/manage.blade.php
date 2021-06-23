@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Product RnD',
                'link' => route('productRnD.create'),
                'text' => 'Create Product Rnd'
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
                                        <tr class="text-center">
                                            <th>RnD Image</th>
                                            <th>RnD Title</th>
                                            <th>Create Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                        @foreach($productRnDs as $index => $productRnD)
                        <tr>
                            <td>
                                <img src="{{assetImageAndVideo('images').$productRnD->rnd_image}}" alt="{{$productRnD->title}}" class="img-rounded" width="80" />
                            </td>
                            <td>{{$productRnD->title}}</td>

                            <td>{{\Carbon\Carbon::parse($productRnD->created_at)->format('M d Y')}}</td>
                            <td>
                                <a href="{{route('productRnD.edit',$productRnD->id)}}" class="btn text-warning btn-app float-left">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$productRnD->id}}">
                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$productRnD->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('productRnD.destroy',$productRnD->id)}}" method="post">
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
                                        <th>RnD Image</th>
                                        <th>RnD Title</th>
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
