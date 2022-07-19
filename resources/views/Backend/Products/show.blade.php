<div class="col-sm-6 col-md-4 col-xl-3">
    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Chi tiết Sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="showDetailProduct"
                        class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="">
                                <th width="20%">Ảnh</th>
                                <th>Nhà cung cấp</th>
                                <th>Danh mục</th>
                                <th>Người tạo</th>
                                <th>Mô tả</th>
                        </thead>

                        <tbody id="myTable">

                            @if ($product->count())
                                    <tr class="">

                                        <td>
                                            <img class="w-100"
                                                src="{{ !empty($product->photo) ? url('uploads/admin_img/' . $product->photo) : url('uploads/no_image.jpg') }}"
                                                alt="Card image cap">
                                        </td>
                                        <td>{{ $product->supplier->name }} </td>
                                        <td>{{ $product->category->nameVi }}-{{ $product->category->nameEn }}</td>
                                        <td>
                                            @if ($product->user_id == $product->created_by)
                                                {{ $product->user->name }}
                                            @endif
                                        </td>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                            @else
                                <tr>
                                    <td colspan="6">Chưa có dữ liệu...</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
