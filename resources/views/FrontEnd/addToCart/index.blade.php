@extends('FrontEnd.master')
@section('content')
    {{-- {{ dd(session()->invalidate()) }} --}}
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('FrontEnd/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Trang chủ </a>
                            <span>giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $totalAll = 0;
                                @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        @php
                                            $total = $details['price'] * $details['quantity'];
                                            $totalAll += $total;
                                        @endphp
                                        <tr data-id="{{ $id }}" class="item-{{ $id }} cartPage">
                                            <td class="shoping__cart__item" data-th="Product">
                                                <img src="{{ asset('frontend/img/cart/cart-1.jpg') }}" alt="">
                                                <h5>{{ $details['nameVi'] ?? '' }}</h5>
                                            </td>
                                            <td class="shoping__cart__price price" data-th="Price">
                                                {{ $details['price'] }}
                                            </td>
                                            {{-- <input type="number" data-id="{{ $id }}"
                                                name="quantity[]" step="1" class="quantity update-cart"
                                                value="{{ $details['quantity'] }}"> --}}
                                            <td class="shoping__cart__quantity"data-th="Quantity">
                                                <div class="input-group inline-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary btn-minus changeQuantity"
                                                            data-id="{{ $id }}">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input class="form-control quantity " min="0" name="quantity[]"
                                                        value="{{ $details['quantity'] }}" type="number"
                                                        data-id="{{ $id }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-plus changeQuantity"
                                                            data-id="{{ $id }}">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                <span
                                                    class="total_cart-{{ $id }}">{{ number_format($total) }}.vnd
                                                </span>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a data-href="{{ route('remove.from.cart', $id) }}"
                                                    class="btn btn-danger btn-sm fa fa-window-close"
                                                    id="{{ $id }}"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            Giỏ hàng của bạn chưa có sản phẩm nào? click vào đây để đặt hàng
                                            <a href="{{ route('showproduct') }}" class="primary-btn cart-btn">Cửa hàng</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('showproduct') }}" class="primary-btn cart-btn">Tiếp tục mua hàng</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Voucher</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <div id="TotalAllRefreshAjax">
                            <div id="">
                                <h5>Thanh Toán</h5>
                                <ul>
                                    <li>Phương thức thanh toán <span>Free</span></li>
                                    <li>Tổng thanh toán
                                        <span class="TotalAllAjaxCall">
                                            {{ number_format($totalAll) }}.vnd
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if (session('cart'))
                            <a href="{{ route('checkOuts') }}" class="primary-btn">Mua hàng</a>
                        @else
                            <a href="{{ route('showproduct') }}" class="primary-btn">Giỏ hàng của bạn đang trống</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".changeQuantity").click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var quantity = $(this).parents("tr").find("input.quantity").val();
                $.ajax({
                    url: '{{ route('update.cart') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity,
                    },
                    success: function(response) {
                        // window.location.reload();
                        $('.total_cart-' + id).html(response.totalCart);
                        $('.TotalAllAjaxCall').html(response.TotalAllRefreshAjax);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);
                    }
                });
            });

            $(document).on('click', '.fa-window-close', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let href = $(this).data('href');
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: href,
                    method: 'delete',
                    data: {
                        _token: csrf
                    },
                    success: function(response) {
                        $('.item-' + id).remove();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.status);

                    }
                });
            });

        });
        $('.btn-plus, .btn-minus').on('click', function(e) {
            const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
            const input = $(e.target).closest('.input-group').find('input');
            if (input.is('input')) {
                input[0][isNegative ? 'stepDown' : 'stepUp']()
            }
        })
    </script>
@endsection
