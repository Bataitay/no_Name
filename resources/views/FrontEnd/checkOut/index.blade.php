@extends('FrontEnd.master')
@section('content')
    {{-- {{ dd(session()->invalidate()) }} --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>

                <form class="checkout-form" method="POST" action="{{ route('order') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text" name="name"
                                            value={{ Auth::guard('customers')->user()->name ?? '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="number" name="phone"
                                            value="{{ Auth::guard('customers')->user()->phone ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="example-text-input" class="form-label">Tỉnh/Thành phố<span>*</span></label>
                                    <select name="province_id" id="province_id" class="form-control province_id"
                                        aria-label="Default select example" data-toggle="select2">
                                        <option selected="" value="">Vui lòng chọn</option>
                                        {{-- @if (Auth::guard('customers')->user()->check()) --}}
                                        @foreach ($allProvinces as $province)
                                            <option value="{{ $province->id }}" @selected($province->id == Auth::guard('customers')->user()->province_id)>
                                                {{ $province->name }}</option>
                                        @endforeach
                                        {{-- @endif --}}
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="example-text-input" class="form-label">Huyện/Quận<span>*</span></label>
                                    <select name="district_id" id="district_id" class="form-control district_id"
                                        aria-label="Default select example">
                                        <option selected="" value="">Vui lòng chọn</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Xã/Phường<span>*</span></label>
                                    <select name="ward_id" class="form-control ward_id" aria-label="Default select example"
                                        id="ward_id">
                                        <option selected="" value="">Vui lòng chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <label>Số nhà, tên đường<span>*</span></label>
                                        <input type="text" name="address">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <label>Ghi chú<span>*</span></label>
                                        <input type="text" name="note">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @php $totalAll = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            @php
                                                $total = $details['price'] * $details['quantity'];
                                                $totalAll += $total;
                                            @endphp
                                            <li>
                                                <input type="hidden" value="{{ $id }}"
                                                    name="product_id[]">{{ $details['nameVi'] ?? '' }} x
                                                <input type="hidden" value="{{ $details['quantity'] }}"
                                                    name="quantity[]">{{ $details['quantity'] ?? '' }}
                                                <span><input type="hidden" value="{{ $total }}"
                                                        name="total[]">{{ $total }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                                <div class="checkout__order__total">Total <span><input type="hidden"
                                            value="{{ $totalAll }}" name="totalAll">${{ $totalAll }}</span></div>

                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Thu hộ
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Thẻ ngân hàng
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit"  class="site-btn payment">Thanh Toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '.province_id, .payment', function() {
                var province_id = $(this).val();
                var district_name = $('.district_id').find('option:selected').text();
                if (province_id == '') {
                    $('#province_id').notify("Lỗi:Địa chỉ không được để trống", {
                        globalPosition: 'top left',
                    });
                    return false;
                }

                $.ajax({
                    url: "{{ route('getDistricts') }}",
                    type: "GET",
                    data: {
                        province_id: province_id
                    },
                    success: function(data) {
                        var html = '<option value="">Vui lòng chọn</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.province_id + ' "> ' + v
                                .name + '</option>';
                        });
                        $('.district_id').html(html);
                    }
                })
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#district_id, .payment', function() {
                var district_id = $(this).val();
                var ward_id = $(this).val();
                var ward_name = $('.ward_id').find('option:selected').text();
                if (district_id == '') {
                    $('#district_id').notify("Lỗi:Địa chỉ không được để trống", {
                        globalPosition: 'top left',
                    });
                    return false;
                }
                if (ward_id == '') {
                    $('#ward_id').notify("Lỗi:Địa chỉ không được để trống", {
                        globalPosition: 'top left',
                    });
                    return false;
                }
                $.ajax({
                    url: "{{ route('getWards') }}",
                    type: "GET",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Vui lòng chọn</option>';
                        $.each(data, function(key, v) {
                            html += '<option value =" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#ward_id').html(html);
                    }
                })
            });
        });
    </script>
@endsection
