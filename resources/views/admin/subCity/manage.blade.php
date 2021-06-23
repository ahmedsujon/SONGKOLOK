@extends('layouts.app_admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('layouts.admin_blade_title', [
                'title' => 'Manage Delivery Area (Sub City) ',
                'link' => route('subCity.create'),
                'text' => "Upload Delivery Area (Sub City)"
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
                            <th>Sub City</th>
                            <th>City</th>
                            <th>District</th>
                            <th>Division</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($subCities as $index => $subCity)
                            @if( ! empty($subCity->district) && ! empty($subCity->division && !empty($subCity->city)) )
                                <tr>
                                    <td style="width: 19%">{{$subCity->sub_city_name}}</td>
                                    <td style="width: 19%">{{$subCity->city->city_name}}</td>
                                    <td style="width: 19%">{{$subCity->district->district_name}}</td>
                                    <td style="width: 19%">{{$subCity->division->division_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($subCity->created_at)->format('M d Y')}}</td>
                                    <td >
                                        <a href="{{route('subCity.edit',$subCity->id)}}" style="margin: 0px 0px 10px 0px" class="btn text-warning btn-app float-left">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="" style="margin: 0px 0px 10px 0px" class="btn btn-app text-danger float-left" data-toggle="modal" data-target="#exampleModal{{$subCity->id}}">
                                            <i class="fa fa-trash fa-2x"></i> DELETE
                                        </a>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$subCity->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete !!!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('subCity.destroy',$subCity->id)}}" method="post">
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
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sub City</th>
                            <th>City</th>
                            <th>District</th>
                            <th>Division</th>
                            <th>Created at</th>
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
