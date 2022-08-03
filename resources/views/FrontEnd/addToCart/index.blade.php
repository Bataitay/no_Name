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
                                @php $total = 0 @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr class="item-{{ $id }}" data-id="{{ $id }}">
                                            <td class="shoping__cart__item" data-th="Product">
                                                <img src="{{ asset('frontend/img/cart/cart-1.jpg') }}" alt="">
                                                <h5>{{ $details['nameVi'] ?? '' }}</h5>
                                            </td>
                                            <td class="shoping__cart__price" data-th="Price">
                                                {{ $details['price'] }}.vnd
                                            </td>
                                            <td class="shoping__cart__quantity"data-th="Quantity">
                                                <div class="">
                                                    <div class="pro-qty">
                                                        <input type="number" value="{{ $details['quantity'] }}"  class="quantity update-cart">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ $details['price'] * $details['quantity'] }}.vnd
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a data-href="{{ route('remove.from.cart', $id) }}" class="btn btn-danger btn-sm fa fa-window-close"
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
                        {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> --}}
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
                        <h5>Thanh Toán</h5>
                        <ul>
                            <li>Phương thức thanh toán <span>Free</span></li>
                            <li>Tổng thanh toán <span>{{ $total }}.vnd</span></li>
                        </ul>
                        @if(session('cart'))
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
            $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "post",
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
                        success: function(res) {
                            $('.item-' + id).remove();
                        }
                    });
                });

        });
    </script>
@endsection
