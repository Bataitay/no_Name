@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chỉnh Sửa danh mục</h4><br><br>
                            <form method="post" action="{{ route('product.update', $product->id) }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">
                                        Tên nhà cung cấp
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <select id="supplier_id " name="supplier_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Chọn nhà cung cấp</option>
                                            @foreach ($suppliers as $supp)
                                                <option value="{{ $supp->id }}"
                                                    @if ($product->category->supplier_id == $supp->id) selected @endif>{{ $supp->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">
                                        Tên danh mục
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <option selected="">Chọn nhà cung cấp</option>
                                        <select class="form-select" name="category_id" id="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nameVi }}-{{ $category->nameEn }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="nameVi" class="col-sm-2 col-form-label">
                                        Tên sản phẩm(Vi)
                                    </label>
                                    <div class="form-group col-sm-10 d-flex">
                                        <input type="text" value="{{ old('nameVi', $product->nameVi) }}"
                                            class="form-control" name="nameVi" id="nameVi"
                                            placeholder=" Nhập tên sản phẩm">
                                        @error('nameVi')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label " for="name">Tên sản phẩm(En)</label>

                                    <div class="form-group col-sm-10">
                                        <input type="text" value="{{ old('nameEn', $product->nameEn) }}"
                                            class="form-control" name="nameEn" id="nameEn"
                                            placeholder=" Nhập tên sản phẩm">
                                        @error('nameEn')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label " for="price">Giá</label>

                                    <div class="form-group col-sm-10">
                                        <input type="text" value="{{ old('price', $product->price) }}"
                                            class="form-control" name="price" id="price" placeholder="Nhập Giá">
                                        @error('nameEn')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label " for="quantity">Số lượng</label>

                                    <div class="form-group col-sm-10">
                                        <input type="text" value="{{ old('quantity', $product->quantity) }}"
                                            class="form-control" name="quantity" id="quantity" placeholder="Nhập Số lượng">

                                        @error('nameEn')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label " for="description">Mô tả</label>

                                    <div class="form-group col-sm-10">
                                        <input type="text" value="{{ old('description', $product->description) }}"
                                            class="form-control" name="description" id="quantity" placeholder="Nhập Số lượng">

                                        @error('description')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="role_name" class="col-sm-2 col-form-label ">Ảnh</label>
                                    <div class="form-group col-sm-3">
                                        <label for="role_name" class="col-form-label imageMain">Ảnh Chính</label>
                                        <input type="file" name="image" id="image" class="img-fluid"  /><br>
                                        <img id="showImage" class="rounded  avatar-lg"
                                            src="{{ !empty($product->image) ? asset($product->image) : asset('uploads/no_image.jpg') }}">
                                    </div>
                                    <div class="form-group col-sm-7">
                                        <label for="role_name" class="col-form-label imageDt">Ảnh chi tiết</label><br>
                                        <input type="file" name="images[]" id="image" class="img-fluid " multiple />
                                        <img id="showImageDl" class="rounded  avatar-lg"
                                            src="{{ !empty($product->image) ? asset($product->image) : asset('uploads/no_image.jpg') }}">
                                    </div>
                                </div>

                                <!-- end row -->

                                <a class="btn btn-danger waves-effect waves-light"
                                    href="{{ route('product.index') }}">Huỷ</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Cập nhật ">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });

    </script>
@endsection
