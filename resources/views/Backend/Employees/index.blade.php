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
                            <div class="row">
                                <div class="col-sm-12 col-md-9 ">
                                    <div class="search_category ">
                                        <label class="col-md-2 " for="">Tìm Kiếm</label>
                                        <input class="form-control  form-control-sm " type="search" id="myInput">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 ">
                                    <div class="action_add">
                                        @can('Employee create')
                                            <a href="{{ route('employee.create') }}"
                                                class="btn btn-dark btn-rounded waves-effect waves-light"
                                                style="float:right;">Thêm nhân viên</a>
                                        @endcan
                                    </div>
                                </div>

                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
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

                                <tbody id="myTable">

                                    @if (!$employees->count())
                                        <tr>
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @else
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->id }} </td>
                                                <td>{{ $employee->name }} </td>
                                                <td>{{ $employee->email }} </td>
                                                <td>{{ $employee->phone }} </td>
                                                <td>{{ $employee->address }} </td>
                                                <td>
                                                    @can('Employee update')
                                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                                            class="btn btn-info sm" title="Edit Data"> <i
                                                                class="fas fa-edit "></i> </a>
                                                    @endcan
                                                    @can('Employee delete')
                                                        <a href="#" id="{{ $employee->id }}"
                                                            class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            {{-- <ul class="pagination justify-content-end">
                              <li class="page-item disabled"> --}}
                            {{-- {{ $users->links() }} --}}

                            {{-- </li>
                            </ul> --}}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    
@endsection
