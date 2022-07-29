@extends('Backend.master')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý danh mục</h4>
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
                                <div class="col-sm-12 col-md-3 ">
                                    <div class="action_add">
<<<<<<< HEAD
                                        @can('Category create')
                                            <a href="{{ route('categories.trashed') }}"
                                                class="btn btn-danger btn-rounded waves-effect waves-light"
                                                style="float:right;">Thùng
                                                rác</a>
                                        @endcan
=======
                                        <a href="{{ route('categories.trashed') }}"
                                            class="btn btn-danger btn-rounded waves-effect waves-light"
                                            style="float:right;">Thùng
                                            rác</a>
>>>>>>> 675112841f2e90a692d2ed445afa2d7bcf0c8cb9
                                        @can('Category create')
                                            <a href="{{ route('category.create') }}"
                                                class="btn btn-dark btn-rounded waves-effect waves-light"
                                                >Thêm Danh
                                                mục</a>
                                        @endcan
                                    </div>
                                </div>

                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="" role="row">
                                        <th width="5%">Mã danh mục</th>
                                        <th>Tên danh mục(Vi)</th>
                                        <th>Tên danh mục(En)</th>
                                        <th>Số lượng sản phẩm</th>
                                        <th>Thời gian cập nhật</th>
                                        <th width="20%">Thao tác</th>
                                </thead>

                                <tbody id="myTable">

                                    @if (!$categories->count())
                                        <tr>
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @else
                                        @foreach ($categories as $category)
                                            <tr class="item-{{ $category->id }}">
                                                <td> {{ $category->id }}</td>
                                                <td>{{ $category->nameVi }} </td>
                                                <td>{{ $category->nameEn }} </td>
                                                <td> {{ $category->products->count() }}</td>
                                                <td>{{ $category->updated_by }} </td>
                                                <td>
<<<<<<< HEAD
                                                    @can('Category update')
=======
<<<<<<< HEAD
                                                    @can('Category update')
=======
                                                    @can('Employee update')
>>>>>>> 0da327349a868451857b3ac1b727941aac25a41f
>>>>>>> 675112841f2e90a692d2ed445afa2d7bcf0c8cb9
                                                        <a href="{{ route('category.edit', $category->id) }}"
                                                            class="btn btn-info sm" title="Edit Data"> <i
                                                                class="fas fa-edit "></i> </a>
                                                    @endcan
                                                    @can('Category delete')
                                                        <a href="#" id="{{ $category->id }}"
                                                            class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-7">
                                    Hiển thị {{ $categories->perPage() }} - {{ $categories->currentPage() }} của {{ $categories->lastPage() }}
                                </div>
                                <div class="col-5" >
                                    <div class="btn-group float-end">

                                        {{ $categories->links() }}
                                    </div>
                                </div>
                            </div>

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
    @isset($category)
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
                            url: '{{ route('category.destroy', 0) }}',
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
            $(document).ready(function() {
                //#myInput id input-event onkey-up
                $('#myInput').on('keyup', function(event) {
                    event.preventDefault();
                    //toLowerCase tìm chữ hoa và thường
                    let key = $(this).val().toLowerCase();
                    //<tbody id="myTable"> -> tr
                    $('#myTable tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(key) > -1);
                    });
                });
            });
        </script>
    @endisset

@endsection
