<div class="modal fade " id="EditProduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <h4 class="mb-4">let's go...</h4>
                    <form action="{{ route('product.update', $product->id) }}"enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="nameVi">Tên sản phẩm(Vi)</label>
                                    <input type="text" value="{{ old('nameVi',$product->nameVi) }}" class="form-control"
                                       name="nameVi" id="nameVi" placeholder=" Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Tên sản phẩm(En)</label>
                                    <input type="text" value="{{ old('nameEn', $product->nameEn) }}" class="form-control"
                                      name="nameEn"  id="nameEn" placeholder=" Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label" for="price">Giá</label>
                                    <input type="text" value="{{ old('price', $product->price) }}" class="form-control"
                                      name="price"  id="price" placeholder="Nhập Giá">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label" for="quantity">Số lượng</label>
                                    <input type="text" value="{{ old('quantity', $product->quantity) }}" class="form-control"
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
                                    <label class="form-label" for="photo">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label" for="discription">Mô tả</label>
                                    <textarea name="description" class="form-control" id="discription" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label text-danger" for=""><i
                                            class="mdi-archive-arrow-down"></i></label><br>
                                    <img id="showPhoto" class="rounded w-50 h-50 avatar-lg "
                                        src="{{ !empty($product->image) ? url('uploads/admin_img/' . $product->image) : url('uploads/no_image.jpg') }}"
                                        alt="Card image cap">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            </div>
            </form>

        </div>
    </div>
</div>


<style>
    .modal-dialog {
        max-width: 1200px;
        margin: 1.75rem auto;
    }
    .form-label {
    margin-bottom: .5rem;
    float: left;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#photo').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showPhoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
