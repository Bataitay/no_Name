{{-- @extends('Backend.master')
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

            {{-- <div class="page-section">
                <form method="post" action="{{ route('admin.updateprofile', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    {{-- <div class="card">
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
                            <div class="form-group">
                                <label> Địa chỉ </label> <input name="address" type="text" class="form-control"
                                    id="" placeholder="Nhập địa chỉ" value="{{ old('address', $user->address) }}">
                                <label>Ghi chú</label> <input name="note" type="text" class="form-control"
                                    id="" placeholder="Nhập ghi chú" value="{{ old('note', $user->note) }}">
                            </div>

                        </div>
                        <div class="card-body border-top">
                            <legend>Thông tin đơn hàng</legend>

                            <div class="row">


                                <div class="page-content">
                                    <div class="container-fluid">
                                        <table id="cart" class="table table-hover table-condensed">
                                            <thead>
                                                <tr>
                                                    <th style="width:50%">Product</th>
                                                    <th style="width:10%">Price</th>
                                                    <th style="width:8%">Quantity</th>
                                                    <th style="width:22%" class="text-center">Subtotal</th>
                                                    <th style="width:10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0 @endphp
                                                @if (session('cart'))
                                                    @foreach (session('cart') as $id => $details)
                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                        <tr data-id="{{ $id }}">
                                                            <td data-th="Product">
                                                                <div class="row">
                                                                    <div class="col-sm-3 hidden-xs"><img src="" width="100" height="100"
                                                                            class="img-responsive" /></div>
                                                                    <div class="col-sm-9">
                                                                        <h4 class="nomargin">{{ $details['nameVi'] ?? '' }}</h4>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td data-th="Price">${{ $details['price'] }}</td>
                                                            <td data-th="Quantity">
                                                                <input type="number" value="{{ $details['quantity'] }}"
                                                                    class="form-control quantity update-cart" />
                                                            </td>
                                                            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}
                                                            </td>
                                                            <td class="actions" data-th="">
                                                                <button class="btn btn-danger btn-sm remove-from-cart">Xóa</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right">
                                                        <h3><strong>Total ${{ $total }}</strong></h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-right">
                                                        <a href="{{ route('showproduct') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                                            Continue
                                                            Shopping</a>
                                                        <button class="btn btn-danger">Checkout</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


                            </div>



                            <div class="form-group">

                                <br>
                                <div class="form-actions">
                                    <a class="btn btn-secondary float-right"
                                        onclick="window.history.go(-1); return false;">Hủy</a>
                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Check-out">

                                </div>
                            </div>
                        </div>
                    </div> --}}
                {{-- </form> --}}



            {{-- </div> --}}
        {{-- </div>
    </div>  --}}
    {{-- <script type="text/javascript">
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

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection --}}

