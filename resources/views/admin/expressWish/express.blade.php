@extends('layouts.app_admin')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Express wishes'
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
                                        <th>User Name</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Stock</th>
                                        <th>Product Price</th>
                                        <th>Wish Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( isset($expresswishes) )
                                        @foreach($expresswishes as $index => $expressWish)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$expressWish->user->fname .' '.$expressWish->user->lname}}</td>
                                            <td><img src="{{assetImageAndVideo('images').$expressWish->product->feature_image}}" alt="{{$expressWish->product->product_name}}" width="80"></td>
                                            <td>{{$expressWish->product->product_name}}</td>
                                            <td>{{$expressWish->product->stock}} piece(s) </td>
                                            <td>BDT {{$expressWish->product->product_price}}</td>
                                            <td>{{\Carbon\Carbon::parse($expressWish->created_at)->format('M d Y')}}</td>
                                            <td>
                                                <a href="" class="btn btn-app text-danger float-left" data-toggle="modal" data-target="#exampleModal{{$expressWish->id}}">
                                                    <i class="fa fa-trash fa-2x"></i> DELETE
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$expressWish->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete !!!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('expressWish.destroy',$expressWish->id)}}" method="post">
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
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Stock</th>
                                        <th>Product Price</th>
                                        <th>Wish Date</th>
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
    <!-- Content Wrapper. Contains page content -->
@endsection
