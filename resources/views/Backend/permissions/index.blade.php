@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý Quyền</h4>
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
                                        @can('Permission create')
                                            <a href="{{ route('permission.create') }}"
                                                class="btn btn-dark btn-rounded waves-effect waves-light"
                                                style="float:right;">Thêm quyền</a>
                                        @endcan
                                    </div>
                                </div>

                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="20%">Nhóm quyền</th>
                                        <th>Tên Quyền</th>
                                        <th width="20%">Thao tác</th>

                                </thead>

                                <tbody id="myTable">

                                    @if (!$permissions->count())
                                        <tr>
                                            <td colspan="5">Chưa có dữ liệu...</td>
                                        </tr>
                                    @else
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td class="py-4 px-6 border-b border-grey-light">{{ $permission->role }}
                                                </td>
                                                <td class="py-4 px-6 border-b border-grey-light">{{ $permission->name }}
                                                </td>
                                                <td>
                                                    {{-- @if ($permission->role->name !== 'Super Admin') --}}
                                                    @can('Permission update')
                                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                                            class="btn btn-info sm" title="Edit Data"> <i
                                                                class="fas fa-edit "></i> </a>
                                                    @endcan
                                                    @can('Permission delete')
                                                        <form action="{{ route('permission.destroy', $permission->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger sm deleteIcon"><i
                                                                    class=" fas fa-trash-alt "></i></button>
                                                        </form>
                                                    @endcan
                                                    {{-- @endif --}}
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
