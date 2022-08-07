<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- selec2 cdn --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm theo yêu cầu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nameVi">Danh mục</label>
                                <select class=" form-control" name="category_id" multiple="multiple"  id="category_id">
                                    <option value=""> Vui lòng chọn </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->nameVi }}-{{ $category->nameEn }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Khoảng giá</label>
                                <input type="number" value="{{ old('startPrice') }}" class="form-control"
                                    name="startPrice" id="startPrice" placeholder="$ Từ">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="name">.</label>
                                <input type="text" value="{{ old('endPrice') }}" class="form-control" name="endPrice"
                                    id="endPrice" placeholder="$ Đến">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">Thời gian cập nhật</label>
                                <input type="date" name="start_date" placeholder="dd/mm/yyyy"
                                    class="form-control start_date" value=""
                                    min="{{ Carbon\Carbon::now()->firstOfYear()->format('d-m-Y') }}"
                                    max="{{ Carbon\Carbon::now()->lastOfYear()->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">.</label>
                                <input type="date" class="form-control" name="end_date" placeholder="dd/mm/yyyy"
                                    class="form-control end_date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Trạng thái:</b></p>
                                <input type="radio" id="html" checked name="status" value="0">
                                <label for="html">Ẩn </label><br>
                                <input type="radio" id="css" checked name="status" value="1">
                                <label for="css">Hiện</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>

    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
            // Select2 Multiple
            $('#category_id').select2({
                dropdownParent: $('#exampleModal')
            });

        });
</script>
