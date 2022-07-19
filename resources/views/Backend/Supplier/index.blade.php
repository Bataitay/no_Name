@extends('Backend.master')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý nhà cung cấp</h4>
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
                                        <input class="form-control  form-control-sm " type="search">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 ">
                                    <div class="action_add">
                                        <a href="{{ route('supplier.create') }}"
                                            class="btn btn-dark btn-rounded waves-effect waves-light"
                                            style="float:right;">Thêm Danh
                                            mục</a>
                                    </div>
                                </div>

                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th width="5%">Tên nhà cung cấp</th>
                                        <th>Số điện thoại</th>
                                        <th>E-mail</th>
                                        <th>Địa chỉ</th>
                                        <th width="20%">Thao tác</th>
                                </thead>

                                <tbody id="myTable">

                                    @if ($suppliers->count())
                                        @foreach ($suppliers as $supplier)
                                            <tr class="item-{{ $supplier->id }}">
                                                <td>{{ $supplier->name }} </td>
                                                <td>{{ $supplier->phone }} </td>
                                                <td>{{ $supplier->email }} </td>
                                                <td>{{ $supplier->address }} </td>
                                                <td>
                                                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                                                        class="btn btn-info sm" title="Edit Data"> <i
                                                            class="fas fa-edit "></i> </a>

                                                    <a href="#" id="{{ $supplier->id }}"
                                                        class="btn btn-danger sm deleteIcon"><i
                                                            class=" fas fa-trash-alt "></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr >
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($supplier)
        <script>
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('supplier.destroy', $supplier->id) }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                                $('.item-' + id).remove();
                            }

                        });
                    }
                })
            });
        </script>
    @endisset

@endsection
