@extends('Backend.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('FrontEnd/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('FrontEnd/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('FrontEnd/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('FrontEnd/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('FrontEnd/css/animate.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <form class="checkout-form" method="POST" action="{{ route('order') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="checkout-title">Thanh toán</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" placeholder="Họ và tên *" value="{{ $user->name }}">
                                <input type="text" placeholder="Số điện thoại *" value="{{ $user->phone }}">
                                <input type="email" placeholder="E-mail *" value="{{ $user->email }}">
                                <select name="province_id" class="form-control province_id" data-toggle="select2">
                                    <option>Tỉnh/Thành phố *</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" @selected($province->id == $user->province_id)>
                                            {{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <select name="district_id" class="form-control district_id">
                                    <option>Huyện/Quận *</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" @selected($district->id == $user->district_id)>
                                            {{ $district->name }}</option>
                                    @endforeach;
                                </select>
                                <select name="ward_id" class="form-control ward_id">
                                    <option>Xã/Phường *</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}" @selected($ward->id == $user->ward_id)>
                                            {{ $ward->name }}</option>
                                    @endforeach;
                                </select>
                                <input type="text" placeholder="Địa chỉ cụ thể *" value="{{ $user->address }}">
                                <input type="text" name="note" placeholder="Ghi chú *">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" md-6>
                        <div class="order-card ">
                            <div class="order-details " >
                                <div class="od-warp  " >
                                    <h4 class="checkout-title">Đơn hàng của bạn</h4>
                                    <table  >
                                        <thead>
                                            <tr>
                                                <th width="75%">Tổng Sản phẩm</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody class=" order-table">
                                            @php $totalAll = 0 @endphp
                                            @if (session('cart'))
                                                @foreach (session('cart') as $id => $details)
                                                    <tr>
                                                        @php
                                                        $total = $details['price'] * $details['quantity'];
                                                        $totalAll += $total;

                                                        @endphp
                                                        <td>
                                                            <input type="hidden" value="{{ $id }}" name="product_id[]">{{ $details['nameVi'] ?? '' }}   x
                                                            <input type="hidden" value="{{ $details['quantity'] }}" name="quantity[]">{{ $details['quantity'] ?? '' }}
                                                        </td>
                                                        <td><input type="hidden" value="{{ $total }}" name="total[]">{{ $total }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <tr class="cart-subtotal">
                                                    <td>Đơn vị vận chuyển</td>
                                                    <td>
                                                        <select class="form-control">
                                                            <option value="">Viettel</option>
                                                            <option value="">GHN</option>
                                                            <option value="">GTK</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <td>Mã giảm giá</td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <td>Phương thức thanh toán</td>
                                                    <td>
                                                    <select class="form-control">
                                                        <option value="">thu hộ</option>
                                                        <option value="">Thanh toán qua thẻ</option>
                                                    </select>
                                                </td>
                                                </tr>
                                                <th>Thành tiền </th>
                                                <th><input type="hidden" value="{{ $totalAll }}" name="totalAll">${{ $totalAll }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                            <button type="submit" class="site-btn btn-full">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
