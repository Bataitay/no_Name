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
                                        <th>Thành viên</th>
                                        <th>Doanh thu thực</th>
                                </thead>

                                <tbody id="myTable">

                                    @if (!$customers->count())
                                        <tr>
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @else
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td> {{ $customer->id }}</td>
                                                <td>{{ $customer->name }} </td>
                                                <td>{{ $customer->phone }} </td>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    @if ($customer->id == $order->customer_id)
                                                        @php $total += $order->money_total @endphp
                                                        <td>
                                                            {{ $orderCount }}
                                                        </td>
                                                        <td></td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{ $total }}
                                                </td>

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
