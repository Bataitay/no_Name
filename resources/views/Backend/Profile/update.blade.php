@extends('Backend.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            {{-- <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href=""><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quản Lý Nhân
                            Viên</a>
                    </li>
                </ol>
            </nav>
        </header> --}}

            <div class="page-section">
                <form method="post" action="{{ route('admin.updateprofile', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="card">
                        <div class="card-body">
                            <legend>Thông tin cơ bản</legend>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Họ và Tên</label>
                                        <input name="username" class="form-control" type="text"
                                            value="{{ old('username', $user->username) }}" id="example-text-input">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số Điện thoại</label>
                                        <input name="phone" class="form-control" type="text"
                                            value="{{ old('phone', $user->phone) }}" id="example-text-input">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail</label>
                                        <input name="email" class="form-control" type="text"
                                            value="{{ old('email', $user->email) }}" id="example-text-input">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tỉnh/Thành phố</label>
                                        <select name="province_id" class="form-control province_id" data-toggle="select2">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" @selected($province->id == $user->province_id)>
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quận/Huyện</label>
                                        <select name="district_id" class="form-control district_id">
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" @selected($district->id == $user->district_id)>
                                                    {{ $district->name }}</option>
                                            @endforeach;
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Xã/Phường</label>
                                        <select name="ward_id" class="form-control ward_id">
                                            @foreach ($wards as $ward)
                                                <option value="{{ $ward->id }}" @selected($ward->id == $user->ward_id)>
                                                    {{ $ward->name }}</option>
                                            @endforeach;
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <legend>Thông tin cá nhân</legend>

                            <div class="row">


                                <div class="col-lg-9">

                                    <div class="form-group">
                                        <label>Tên nhân viên<noscript></noscript></label>
                                        <input name="name" type="text" class="form-control" id=""
                                            placeholder="Nhập tên nhân viên" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Giới tính</label>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input type="radio" class="custom-control-input" name="gender" id="rd1"
                                                @if (Auth::user()->gender == 1) Checked @endif value="1">Male <br>
                                            {{-- <label class="custom-control-label" for="rd1">Nam</label> --}}
                                        </div>
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input type="radio" class="custom-control-input" name="gender" id="rd2"
                                                @if (Auth::user()->gender == 0) Checked @endif value="0">
                                            Female
                                            {{-- <label class="custom-control-label" for="rd2">Nữ</label> --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sinh <noscript></noscript></label>
                                        <input name="day_of_birth" type="date" class="form-control" id=""
                                            placeholder="Nhập ngày sinh "
                                            value="{{ old('day_of_birth', $user->day_of_birth) }}">
                                    </div>
                                    <div class="form-group">
<<<<<<< HEAD
                                        <label>Ngày làm việc</label> <input name="start_day" type="date"
                                            class="form-control" id="" placeholder="Nhập ngày làm việc"
=======
                                        <label>Ngày làm việc</label> <input name="start_day" type="date" class="form-control"
                                            id="" placeholder="Nhập ngày làm việc"
>>>>>>> 0da327349a868451857b3ac1b727941aac25a41f
                                            value="{{ old('start_day', $user->start_day) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group md-3">
                                        <label>Hình ảnh nhân viên</label>
<<<<<<< HEAD
                                        <input type="file" name="profile_image" id="filepond"
                                            class="img-fluid filepond rounded-circle" multiple>
                                    </div>
                                    {{-- <div class="card card-figure">
=======
                                        <input type="file" name="profile_image" id="filepond" class="img-fluid filepond rounded-circle" multiple>
                                    </div>
                                    {{-- <div class="card card-figure h-50 w-100">
>>>>>>> 0da327349a868451857b3ac1b727941aac25a41f
                                        <figure class="figure">
                                            <div class="figure-img">
                                                <img id="showImage" class="rounded w-100 h-100 avatar-lg"
                                                    src="{{ !empty($user->image) ? url('uploads/admin_img/' . $user->image) : url('uploads/no_image.jpg') }}"
                                                    alt="Card image cap">
                                                <span class="tile tile-circle bg-danger"><span
                                                        class="oi oi-eye"></span></span>
                                                </a>
                                            </div>
                                        </figure>
                                    </div> --}}
                                </div>

                            </div>

                            <div class="form-group">
                                <label> Địa chỉ </label> <input name="address" type="text" class="form-control"
                                    id="" placeholder="Nhập địa chỉ"
                                    value="{{ old('address', $user->address) }}">
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label> <input name="note" type="text" class="form-control"
                                    id="" placeholder="Nhập ghi chú" value="{{ old('note', $user->note) }}">
                                <br>
                                <div class="form-actions">
                                    <a class="btn btn-secondary float-right"
                                        onclick="window.history.go(-1); return false;">Hủy</a>
                                    <input type="submit" class="btn btn-info waves-effect waves-light"
                                        value="Update Profile">

                                </div>
                            </div>
                        </div>
                    </div>
                </form>



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
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('.province_id').on('change', function() {
                var province_id = jQuery(this).val();

                $.ajax({
                    url: "/api/get_districts/" + province_id,
                    type: "GET",
                    success: function(data) {
                        var districts_html = '<option value="">Vui lòng chọn</option>';
                        for (const district of data) {
                            districts_html += '<option value="' + district.id + '">' +
                                district.name + '</option>';
                        }
                        jQuery('.district_id').html(districts_html);
                    }
                });

            });

            jQuery('.district_id').on('change', function() {
                var district_id = jQuery(this).val();

                $.ajax({
                    url: "/api/get_wards/" + district_id,
                    type: "GET",
                    success: function(data) {
                        var wards_html = '<option value="">Vui lòng chọn</option>';
                        for (const ward of data) {
                            wards_html += '<option value="' + ward.id + '">' + ward.name +
                                '</option>';
                        }
                        jQuery('.ward_id').html(wards_html);
                    }
                });

            });
        });
    </script>
@endsection
