@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý Quyền</h4>
                    </div>
                </div>
            </div>
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
                                        <a href="{{ route('roles.create') }}"
                                            class="btn btn-dark btn-rounded waves-effect waves-light"
                                            style="float:right;">Thêm quyền</a>
                                    </div>
                                </div>
                            </div>
                            <table id="datatable"
                                class="table table-bordered dt-responsive  text-center align-middle dataTable no-footer dtr-inline"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="20%">Tên vai trò</th>
                                        <th>Quyền</th>
                                        <th width="20%">Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody id="myTable">
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td class="">{{ $role->name }}
                                            </td>
                                            <td class="">
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge text-bg-secondary flex-wrap ">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('Role update')
                                                    @if ($role->name != 'Super Admin')
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info sm"
                                                            title="Edit Data"> <i class="fas fa-edit "></i> </a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
