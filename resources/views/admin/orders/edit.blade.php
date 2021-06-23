@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage All Orders'
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
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>Order Date</th>
                                        <th>Pending Shifted</th>
                                        <th>View All Orders</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $index => $order)
                                        @php
                                            $ve = $order->orderWithOutAdmin->count();
                                        @endphp
                                        @if($ve > 0)
                                            <tr>
                                                <td>{{ $index+1}}</td>
                                                <td>{{$order->fname . ' ' . $order->lname}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{$order->phone}}</td>
                                                <td>{{\Carbon\Carbon::parse($order->orderWithOutAdmin[0]->created_at)->format('M d Y')}} </td>
                                                <td class="text-danger">{{$order->orderWithOutAdmin->count()}}</td>

                                                <td>
                                                    <button type="button" id="submitBtnn" class="btn btn-success float-left"  data-target="{{$order->id}}">
                                                        View
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">User all orders</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <table id="example2" class="table table-bordered table-striped">

                                                                        <thead style="background-color: #000;color:#fff">
                                                                        <tr>
                                                                            <th>Order ID</th>
                                                                            <th>Order Date</th>
                                                                            <th>Product</th>
                                                                            <th>Image</th>
                                                                            <th>Model</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price Total</th>
                                                                            <th>Size</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="modalTableBody">
                                                                        </tbody>
                                                                        <tfoot>
                                                                        <tr>
                                                                            <th>Order ID</th>
                                                                            <th>Order Date</th>
                                                                            <th>Product</th>
                                                                            <th>Image</th>
                                                                            <th>Model</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price Total</th>
                                                                            <th>Size</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>

{{--                                                <td>--}}
{{--                                                    <a href="{{route('orders.allOrders',$order->id)}}" class="btn btn-success float-left">--}}
{{--                                                        View--}}
{{--                                                    </a>--}}
{{--                                                </td>--}}

                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>Order Date</th>
                                        <th>Pending Shifted</th>
                                        <th>View All Orders</th>
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

