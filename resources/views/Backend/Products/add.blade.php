@extends('Backend.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Thêm sản phẩm</h4><br><br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Tên nhà cung cấp</label>
                                        <select id="supplier_id" name="supplier_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Chọn nhà cung cấp</option>
                                            @foreach ($suppliers as $supp)
                                                <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Tên danh mục</label>
                                        <select name="category_id" id="category_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->nameVi }}-{{ $category->nameEn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">
                                        </label>
                                        <input type="submit" class="btn btn-secondary btn-rounded waves-effect waves-light"
                                            value="Thêm cột">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="" action="">
                                        @csrf
                                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                            <thead>
                                                <tr>
                                                    <th>Danh mục</th>
                                                    <th>Tên (Vi)</th>
                                                    <th>Tên (En)</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                    <th>Mô tả</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Thao tác</th>

                                                </tr>
                                            </thead>

                                            <tbody id="addRow" class="addRow">

                                            </tbody>

                                            <tbody>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" value="0"
                                                            id="estimated_amount" class="form-control estimated_amount" readonly
                                                            style="background-color: #ddd;">
                                                    </td>
                                                    <td></td>
                                                </tr>

                                            </tbody>
                                        </table><br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info" id="storeButton">Thêm sản phẩm</button>

                                        </div>
                                    </form>
                                </div> <!-- End card-body -->
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <script id="document-template" type="text/x-handlebars-template">
                <tr class="delete_add_more_item" id="delete_add_more_item">
                    <input type="hide" name="supplier_id[]" value="@{{ supplier_id }}">
                    <td>
                        <input type="hide" name="category_id[]" value="@{{ category_id }}">
                    </td>
                    <td>
                        <input type="text" name="nameVi[]" class="form-control " value="">
                    </td>
                    <td>
                        <input type="text" name="nameEn[]" class="form-control" value="">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control quantity text-right" name="quantity[]" value="">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control price text-right" name="price[]" value="">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control price text-right" name="price[]" value="">
                    </td>
                    <td>
                        <input type="text" name="description[]" value="" class="form-control">
                    </td>
                    <td>
                        <input type="number" value="0" class="form-control total text-right" name="total[]" readonly>
                    </td>
                    <td>
                        <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
                    </td>
                </tr>
            </script>
            @endsection
