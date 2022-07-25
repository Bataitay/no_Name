@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm Thông báo</h4><br><br>
                            <form method="post" action="{{ route('notification.store') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">Tiêu đề:</label>
                                    <div class="form-group col-sm-10">
                                        <input name="title" class="form-control" type="text" value="{{ old('title') }}">
                                        {{-- @error('title')
                                            <div  class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input"
                                        class="col-sm-2 col-form-label ">Nội dung:</label>
                                    <div class="form-group col-sm-10">
                                        <input name="content" class="form-control" type="text" value="{{ old('content') }}">
                                        {{-- @error('content')
                                            <div  class="text text-danger"><i class=" ri-spam-2-line"></i>{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                <!-- end row -->

                                {{-- <a class="btn btn-danger waves-effect waves-light" href="{{ route('category.index') }}">Huỷ</a> --}}
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Gửi thông báo">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>


@endsection
