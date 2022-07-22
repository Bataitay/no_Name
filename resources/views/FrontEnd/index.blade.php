@extends('Backend.master')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"></h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h2 class="card-title">Quản lý sản phẩm</h2>
                        <div class="row">
                            <div class="col-sm-12 col-md-9 ">
                                <div class="search_category ">
                                    <label class="col-md-2 " for="">Tìm Kiếm</label>
                                    <input id="myInput" class="form-control  form-control-sm " type="search">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 ">
                                <div class="action_add">
                                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Giỏ
                                        hàng
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                                            class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- Nav tabs -->
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-xs-18 col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img src="" alt="">
                                            <div class="caption">
                                                <h4>{{ $product->nameVi }}</h4>
                                                <p>{{ $product->description }}</p>
                                                <p><strong>Price:{{ $product->price }} </strong> $</p>
                                                <p class="btn-holder"><a data-bs-toggle="modal" data-bs-target="#checkouts" href="{{ route('add.to.cart', $product->id) }}"
                                                        class="btn btn-warning btn-block text-center" role="button">Add
                                                        to cart</a> </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <!-- Tab panes -->


                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div> <!-- end col -->
        </div> <!-- end row -->


        </head>

        <body>

    </div> <!-- container-fluid -->
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
