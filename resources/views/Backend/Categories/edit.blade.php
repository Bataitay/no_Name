@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Chỉnh Sửa danh mục</h4><br><br>
                            <form method="post" action="{{ route('category.update', $category->id) }}" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Tên danh
                                        mục(Vi)</label>
                                    <div class="form-group col-sm-10">
                                        <input name="nameVi" value="{{ old('nameVi', $category->nameVi) }}" class="form-control" type="text">
                                        @error('nameVi')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Tên danh
                                        mục(En)</label>
                                    <div class="form-group col-sm-10">
                                        <input name="nameEn" class="form-control" type="text" value="{{ old('nameEn', $category->nameEn) }}">
                                        @error('nameEn')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Tên nhà cung cấp</label>
                                    {{-- {{ dd($category->supplier_id  ) }} --}}
                                    <div class="form-group col-sm-10">
                                        <select id="supplier_id " name="supplier_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Chọn nhà cung cấp</option>
                                            @foreach ($suppliers as $supp)
                                                <option value="{{ $supp->id }}"
                                                   @if ($category->supplier_id == $supp->id)
                                                     selected
                                                   @endif
                                                    >{{ $supp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <a class="btn btn-danger waves-effect waves-light"
                                    href="{{ route('category.index') }}">Huỷ</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Cập nhật ">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


@endsection
