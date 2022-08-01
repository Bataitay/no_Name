@extends('FrontEnd.master')
@section('content')
    <!-- Hero Section Begin -->
    @include('FrontEnd.layouts.heroSection')
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    @include('FrontEnd.layouts.categoriesSection')

    <!-- Categories Section End -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($products as $product)
                    @if ($product->status == '1')
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                    data-setbg="{{ asset('FrontEnd/img/featured/feature-2.jpg') }}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a id="addToCart" data-href="{{ route('add.to.cart', $product->id) }}"
                                                id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">{{ $product->nameVi }}</a></h6>
                                    <h5>${{ $product->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            $(document).on('click', '#addToCart', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let href = $(this).data('href');
                $.ajax({
                    url: href,
                    method: "get",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    // success: function(response) {

                    // }
                });
            });
        })
    </script>
@endsection
