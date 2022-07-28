<<<<<<< HEAD
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
=======
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="nameVi">Tên sản phẩm(Vi)</label>
                                    <input type="text" value="{{ old('nameVi') }}" class="form-control"
                                        name="nameVi" id="nameVi" placeholder=" Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Tên sản phẩm(En)</label>
                                    <input type="text" value="{{ old('nameEn') }}" class="form-control"
                                        name="nameEn" id="nameEn" placeholder=" Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label" for="price">Giá</label>
                                    <input type="text" value="{{ old('price') }}" class="form-control"
                                        name="price" id="price" placeholder="Nhập Giá">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label" for="quantity">Số lượng</label>
                                    <input type="text" value="{{ old('quantity') }}" class="form-control"
                                        name="quantity" id="quantity" placeholder="Nhập Số lượng">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nhà cung cấp</label>
                                    <select class="form-select" name="supplier_id">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Danh mục(Vi-En)</label>
                                    <select class="form-select" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->nameVi }}-{{ $category->nameEn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="discription">Mô tả</label>
                                    <textarea name="description" class="form-control" id="discription" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-lg-12 ">
                                <div class="mb-3 ">
                                    <label class="form-label " for="photo">Ảnh sản phẩm</label><br><br>
                                    <input type="file"  name="photo" id="filepond" class="img-fluid filepond" multiple/>
>>>>>>> 0da327349a868451857b3ac1b727941aac25a41f
                                </div>





                            </div> <!-- // end row  -->

                        </div> <!-- End card-body -->
                        <!--  ---------------------------------- -->

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
