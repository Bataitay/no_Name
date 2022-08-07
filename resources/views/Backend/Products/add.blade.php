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
                                            <option selected="" value="">Chọn nhà cung cấp</option>
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
                                            <option selected="" value="">Chọn danh mục</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">
                                        </label>
                                        <i
                                            class="btn btn-secondary btn-rounded waves-effect waves-light
                                        mdi mdi-plus-circle addeventmore">Thêm
                                            cột</i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('product.store') }}">
                                        @csrf
                                        <table
                                            class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                            style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th width="17%">Danh mục</th>
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
                                                            id="estimated_amount" class="form-control estimated_amount"
                                                            readonly style="background-color: #ddd;">
                                                    </td>
                                                    <td></td>
                                                </tr>

                                            </tbody>
                                        </table><br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info" id="storeButton">Thêm sản
                                                phẩm</button>

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
                    <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
                    <td>
                        <input type="hidden" name="category_id[]" class="form-control  text-right" value="@{{ category_id }}" >
                        @{{ category_name }}
                    </td>
                    <td>
                        <input type="text" name="nameVi[]" class="form-control " value="">
                    </td>
                    <td>
                        <input type="text" name="nameEn[]" class="form-control" value="">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control quantity text-right" name="quantity[]" value=" old(quantity) ">
                    </td>
                    <td>
                        <input type="number" min="0" class="form-control price text-right" name="price[]" value=" old(price) ">
                    </td>
                    <td>
                        <input type="text" name="description[]" value="" class="form-control">
                    </td>
                    <td>
                        <input type="number" value="0" class="form-control total text-right" name="total[]" readonly>
                    </td>
                    <td>
                        <i class="btn btn-danger btn-sm mdi mdi-close-box removeeventmore"></i>
                    </td>
                </tr>
            </script>
            {{-- ---------------------------add column--------------------------------- --}}
            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on("click", ".addeventmore", function() {
                        var supplier_id = $('#supplier_id').val();
                        var category_id = $('#category_id').val();
                        var category_name = $('#category_id').find('option:selected').text();
                        if (supplier_id == '') {
                            $('#supplier_id').notify("Lỗi:Nhà cung cấp không được để trống", {
                                globalPosition: 'top left',
                            });
                            return false;
                        }
                        if (category_id == '') {
                            $('#category_id').notify("Danh mục không được để trống", {
                                position: "top left",
                            });
                            return false;
                        }
                        var source = $("#document-template").html();
                        var tamplate = Handlebars.compile(source);
                        var data = {
                            supplier_id: supplier_id,
                            category_name: category_name,
                            category_id: category_id,
                        };
                        var html = tamplate(data);
                        $('#addRow').append(html);
                    });
                    $(document).on("click", ".removeeventmore ", function(event) {
                        $(this).closest(".delete_add_more_item").remove();
                        totalAll();
                    })

                    $(document).on('keyup', '.quantity, .price', function(event) {
                        var quantity = $(this).closest('tr').find('input.quantity').val();
                        var price = $(this).closest('tr').find('input.price').val();
                        var total = quantity * price;
                        // console.log(total);
                        $(this).closest('tr').find('input.total').val(total);
                        totalAll();
                    });

                    function totalAll() {
                        var sum = 0;
                        $('.total').each(function() {
                            var value = $(this).val();
                            if (!isNaN(value) && value.length != 0) {
                                sum += parseFloat(value);
                            }
                        });
                        $('#estimated_amount').val(sum);
                    }
                });
            </script>

            {{-- ---------------------------end column--------------------------------- --}}
            <script type="text/javascript">
                $(function() {
                    $(document).on('change', '#supplier_id', function() {
                        var supplier_id = $(this).val();
                        $.ajax({
                            url: '{{ route('get-category') }}',
                            type: 'GET',
                            data: {
                                supplier_id: supplier_id
                            },
                            success: function(data) {
                                var html = '<option value="">Chọn danh mục</option>';
                                $.each(data, function(key, v) {
                                    html += '<option value=" ' + v.id + ' ">' + v.nameEn + '-' +
                                        v.nameVi + '</option>';
                                });
                                $('#category_id').html(html);
                            }

                        });

                    });
                })
            </script>
        @endsection
