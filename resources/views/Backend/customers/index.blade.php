@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý Khách hàng</h4>
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
                                        <input class="form-control  form-control-sm " type="search" id="myInput"
                                            wire:model="search">
                                    </div>
                                </div>
                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="" role="row">
                                        <th width="5%">Mã Khách hàng</th>
                                        <th>Tên Khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Tổng đơn hàng</th>
                                        <th>Doanh thu thực</th>
                                        <th>Thành viên</th>
                                </thead>
                                <tbody id="myTable">
                                    @if (!$customers->count())
                                        <tr>
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @else
                                        @php
                                            $Diamond = 10000000;
                                            $Gold = 5000000;
                                        @endphp
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td> {{ $customer->id }}</td>
                                                <td>{{ $customer->name }} </td>
                                                <td>{{ $customer->phone }} </td>
                                                <td>{{ $customer->total_orders }}</td>
                                                <td>{{ number_format($customer->total_money) }}</td>
                                                @if ($customer->total_money > $Diamond)
                                                    <td> <span>Diamond</span> </td>
                                                @elseif($customer->total_money > $Gold && $customer->total_money < $Diamond)
                                                    <td> <span>Gold</span> </td>
                                                @else
                                                    <td> <span>Silver</span> </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-7">
                                    Hiển thị {{ $customers->perPage() }} - {{ $customers->currentPage() }} của
                                    {{ $customers->lastPage() }}
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        {{ $customers->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
