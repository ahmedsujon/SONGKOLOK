@extends('layouts.app_admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Sell Report'
            ])

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-3">
                        <form class="form-inline mb-4" method="post" action="{{ route('sell.report.post') }}">
                            <div class="form-group">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                      </span>
                                    </div>
                                    <input name="filterDate" type="text" class="form-control float-right" id="reservation">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <button type="submit" class="btn btn-primary ">Search orders</button>
                        </form>
                    </div>
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                    <thead >
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>User Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>In Stock</th>
                                        <th>Total Sell</th>
                                        <th>Product Price</th>
                                        <th>Order Quantity</th>
                                        <th>Sell Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($orders))
                                            @foreach($orders as $index => $product)
                                                <tr>
                                                    <td>{{$product->order->unique_id}}</td>
                                                    <td>{{ $product->product->product_name }}</td>
                                                    <td>{{ $product->user->fname . ' ' .  $product->user->lname}}</td>
                                                    <td>{{ $product->product->brand->brand_name }}</td>
                                                    <td>{{ $product->product->category->category_name }}</td>
                                                    @if( $product->product->stock > 0 )
                                                        <td>{{ $product->product->stock }}</td>
                                                    @else
                                                        <td class="text-danger">Out of stock</td>
                                                    @endif
                                                    <td>{{$product->product->sold}}</td>
                                                    <td>BDT {{$product->product->product_price}}</td>
                                                    <td>{{$product->order->quantity}}</td>
                                                    <td>{{ date('D m, Y', strtotime($product->order->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>User Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>In Stock</th>
                                        <th>Total Sell</th>
                                        <th>Product Price</th>
                                        <th>Order Quantity</th>
                                        <th>Sell Date</th>
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
@endsection
