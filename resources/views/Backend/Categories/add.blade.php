@extends('Backend.master')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-1">
                        <div class="bg-white shadow-md rounded my-6 p-5">
                            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <label for="role_name" class="text-gray-700 select-none font-medium">Tên danh
                                        mục(Vi)</label>
                                    <input id="nameVi" type="text" name="nameVi" value="{{ old('nameVi') }}"
                                        placeholder=""
                                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                    @error('nameVi')
                                        <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label for="role_name" class="text-gray-700 select-none font-medium">Tên danh
                                        mục(En)</label>
                                    <input id="nameEn" type="text" name="nameEn" value="{{ old('nameEn') }}"
                                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                    @error('nameEn')
                                        <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label for="role_name" class="text-gray-700 select-none font-medium">Nhà cung cấp</label>
                                    <select id="supplier_id" name="supplier_id"
                                        class="form-select px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                                        aria-label="Default select example">
                                        <option selected="">Chọn nhà cung cấp</option>
                                        @foreach ($suppliers as $supp)
                                            <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label for="role_name" class="text-gray-700 select-none font-medium">Ảnh</label>
                                    <input type="file" name="image" id="image"
                                        class="img-fluid" />
                                </div>
                                <div class="col-lg-6">
                                    <div class="figure-img h-100">
                                        <img id="showImage" class="rounded  avatar-lg"
                                            src="{{ url('uploads/no_image.jpg') }}" alt="Card image cap">
                                        <span class="tile tile-circle bg-danger"><span class="oi oi-eye"></span></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center mt-16">
                                    <button type="submit"
                                        class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Thêm
                                        danh mục</button>
                                    <a href="{{ route('category.index') }}"
                                        class="bg-red-600 text-white font-bold px-5 py-1.5 rounded focus:outline-none shadow hover:bg-red-600 transition-colors ">Thoát</a>
                                </div>
                        </div>
                    </div>x
                </main>
            </div>
        </div>
    </div>
    <style>
        img {
            display: inline-grid;
            vertical-align: middle;
        }
    </style>
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
    </script>
@endsection
