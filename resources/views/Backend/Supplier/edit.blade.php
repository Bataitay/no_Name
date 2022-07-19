@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Thêm nhà cung cấp</h4><br><br>
                            <form method="post" action="{{ route('supplier.update', supplier->id) }}" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">Tên nhà cung cấp</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" class="form-control" type="text" value="{{ old('name',$supplier->name) }}">
                                        @error('name')
                                            <div  class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">Điện thoại</label>
                                    <div class="form-group col-sm-10">
                                        <input name="phone" class="form-control" type="number" value="{{ old('phone', $supplier->phone) }}">
                                        @error('phone')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">E-mail</label>
                                    <div class="form-group col-sm-10">
                                        <input name="email" class="form-control" type="text" value="{{ old('email',$supplier->email) }}">
                                        @error('email')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">Địa chỉ</label>
                                    <div class="form-group col-sm-10">
                                        <input name="address" class="form-control" type="text" value="{{ old('address',$supplier->address) }}">
                                        @error('address')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <a class="btn btn-danger waves-effect waves-light"
                                    href="{{ route('supplier.index') }}">Huỷ</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Thên nhà cung cấp">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


@endsection
