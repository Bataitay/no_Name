@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý nhân viên</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="" class="btn btn-dark btn-rounded waves-effect waves-light"
                                style="float:right;">Thêm Nhân Viên</a> <br> <br>

                            <h4 class="card-title">Dữ liệu nhân viên </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Mã nhân viên</th>
                                        <th>Họ và tên</th>
                                        <th>Điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Email</th>
                                        <th width="20%">Thao tác</th>

                                </thead>


                                <tbody>
                                    @foreach ($users as $user )
                                    <tr>
                                        <td>{{ $user->id }} </td>
                                        <td>{{ $user->name }} </td>
                                        <td>{{ $user->email }} </td>
                                        <td>{{ $user->phone }} </td>
                                        <td>{{ $user->address }} </td>
                                        <td>
                                            <a href="" class="btn btn-info sm" title="Edit Data"> <i
                                                    class="fas fa-edit"></i> </a>

                                            <a href="" class="btn btn-danger sm" title="Delete Data" id="delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
