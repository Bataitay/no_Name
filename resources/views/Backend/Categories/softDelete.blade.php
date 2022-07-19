@extends('Backend.master')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Thùng rác</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('category.index') }}"
                                class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Xem tất cả
                                sản phẩm</a> <br> <br>
                            <h4 class="card-title">Danh sách danh mục </h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap text-center align-middle"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th width="5%">Mã danh mục</th>
                                        <th>Tên danh mục(Vi)</th>
                                        <th>Tên danh mục(En)</th>
                                        <th>Số lượng sản phẩm</th>
                                        <th>Thời gian cập nhật</th>
                                        <th width="20%">Thao tác</th>
                                </thead>

                                <tbody id="myTable">

                                    @if (!$categories->count())
                                        <h6>Chưa có dữ liệu</h6>
                                    @else
                                        @foreach ($categories as $category)
                                            <tr class="item-{{ $category->id }}">
                                                <td> {{ $category->id }}</td>
                                                <td>{{ $category->nameVi }} </td>
                                                <td>{{ $category->nameEn }} </td>
                                                <td> </td>
                                                <td>{{ $category->updated_by }} </td>
                                                <td class="action_icon">
                                                    <form action="{{ route('categories.restore', $category->id) }}"
                                                        method="">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info sm "
                                                            onclick="return confirm('do you want restore?')"><i
                                                                class="ri-repeat-fill"></i></button>
                                                    </form>
                                                    <form action="{{ route('categories.forceDelete', $category->id) }}"
                                                        method="POST ">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger sm deleteIcon "
                                                            onclick="return confirm('do you want delete forever?')"><i
                                                                class="fas fa-trash-alt "></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>


@endsection
