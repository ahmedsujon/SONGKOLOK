@extends('layouts.app_admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('layouts.admin_blade_title', [
            'title' => 'Manage Brands',
            'link' => route('brand.create'),
            'text' => 'Create Brand',
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
                                        <th>SL</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                        <th>Brand Level</th>
                                        <th>Brand Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                @foreach($brands as $index => $brand)
                                <tr>
                                    <td class="text-center">{{$index + 1}}</td>
                                    <td class="text-center">{{$brand->brand_name}}</td>
                                    <td class="text-center" >
                                        <img width="90" src="{{ assetImageAndVideo('images'). $brand->brand_image }}" alt="{{$brand->brand_name}}">
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('brand.change.level')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$brand->id}}">
                                            <div class="form-group">
                                                <select name="level" class="form-control select2 select2-success" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                    <option value="1" @if($brand->level == 1 ) selected @endif>Top</option>
                                                    <option value="2" @if($brand->level == 2 ) selected @endif>Mid</option>
                                                    <option value="3" @if($brand->level == 3 ) selected @endif>Low</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Update" class="btn btn-success">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('brand.change.status') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="status" value="{{$brand->status}}">
                                            <input type="hidden" name="id" value="{{$brand->id}}">

                                            @if($brand->status == 1)
                                                <button type="submit" class="btn btn-success">Active</button>
                                            @else
                                                <button type="submit" class="btn btn-danger">Inactive</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td class="text-center">{{  \Carbon\Carbon::parse($brand->created_at)->format('M d Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-app float-left">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <a href="" class="btn btn-app text-danger" data-toggle="modal" data-target="#exampleModal{{$brand->id}}">
                                            <i class="fa fa-trash fa-2x"></i> DELETE
                                        </a>

                                        <div class="modal fade" id="exampleModal{{$brand->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this !!!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('brand.destroy',$brand->id)}}" method="post">
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
                                    <th>Brand Name</th>
                                    <th>Brand Logo</th>
                                    <th>Brand Level</th>
                                    <th>Brand Status</th>
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
