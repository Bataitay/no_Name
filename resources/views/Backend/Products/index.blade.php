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
                            <div class="col-lg-4">
                                <form action="" method="">
                                    <div class="mb-4 d-flex">
                                        <input id="myInput" name="keyword"
                                            class="form-control value="{{ old('keyword') }}" form-control-sm " type="text">
                                                        <button type="submit" class="btn btn-warning ">
                                                            Search
                                                        </button>
                                                </div>
                                                </form>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-4">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal">
                                                            Tìm kiếm nâng cao
                                                        </button>

                                                        <!-- Modal -->
                                                       @include('Backend.Products.search')
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <div class="mb-4" style="float:right;">
                                                        @can('Product create')
        <a href="{{ route('product.create') }}"
                                                                                    class="btn btn-dark btn-rounded waves-effect waves-light">Thêm
                                                                                    Sản phẩm</a>
    @endcan
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Home</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#softDelete" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">Thùng Rác</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Messages</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                        <span class="d-none d-sm-block">Settings</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content p-3 text-muted">
                                                <div class="tab-pane active" id="home" role="tabpanel">
                                                    <table id="datatable"
                                                        class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead>
                                                            <tr class="">
                                                                <th>Tên sản phẩm(Vi)</th>
                                                                <th>Tên sản phẩm(En)</th>
                                                                <th width="10%">Giá</th>
                                                                <th>Số lượng</th>
                                                                <th>Trạng thái</th>
                                                                <th>Thời gian cập nhật</th>
                                                                <th width="20%">Thao tác</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="myTableP">

                                                                 @if ($products->count())
                                        @foreach ($products as $product)
                                            <tr class="item-{{ $product->id }}">
                                                <td>{{ $product->nameVi }} </td>
                                                <td>{{ $product->nameEn }} </td>
                                                <td> {{ $product->price }}</td>
                                                <td> {{ $product->quantity }}</td>
                                                <td>
                                                    @if ($product->status == '0')
                                                        <a href="{{ route('showToFe', $product->id) }}"
                                                            class="btn btn-warning">Ẩn</a>
                                                    @elseif($product->status == '1')
                                                        <a href="{{ route('hideToFe', $product->id) }}"
                                                            class="btn btn-success">Hiện</a>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($product->updated_by)) }} </td>
                                                <td>
                                                    @can('Product update')
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            class="btn btn-info sm">
                                                            <i class="fas fa-edit "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Product delete')
                                                        <a data-href="{{ route('product.destroy', $product->id) }}"
                                                            id="{{ $product->id }}" class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                    @can('Product view')
                                                        <a href="{{ route('product.show', $product->id) }}"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bs-example-modal-lg{{ $product->id }}"><i
                                                                class="ri-eye-close-fill"></i></a>
                                                        @include('Backend.Products.show')
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">Chưa có dữ liệu...</td>
                                        </tr>
                                        @endif

                                        </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-7">
                                                Hiển thị {{ $products->perPage() }} - {{ $products->currentPage() }} của
                                                {{ $products->lastPage() }}
                                            </div>
                                            <div class="col-5">
                                                <div class="btn-group float-end">
                                                    {{ $products->appends(request()->all())->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="softDelete" role="tabpanel">
                                        <p class="mb-0">
                                            @include('Backend.Products.softDelete')

                                        </p>
                                    </div>
                                    <div class="tab-pane" id="messages" role="tabpanel">
                                        <p class="mb-0">
                                            Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                            sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                            farm-to-table readymade. Messenger bag gentrify pitchfork
                                            tattooed craft beer, iphone skateboard locavore carles etsy
                                            salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                            Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                            mi whatever gluten yr.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="settings" role="tabpanel">
                                        <p class="mb-0">
                                            Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                            art party before they sold out master cleanse gluten-free squid
                                            scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                            art party locavore wolf cliche high life echo park Austin. Cred
                                            vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                            farm-to-table VHS.
                                        </p>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>


    </head>

    <body>

        </div> <!-- container-fluid -->
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @isset($product)
            <script>
                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    let href = $(this).data('href');
                    let csrf = '{{ csrf_token() }}';
                    console.log(id);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: href,
                                method: 'delete',
                                data: {
                                    _token: csrf
                                },
                                success: function(res) {
                                    Swal.fire(
                                        // console.log(res);
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    $('.item-' + id).remove();

                                }

                            });
                        }
                    })
                });
                // $(document).ready(function() {
                //     //#myInput id input-event onkey-up
                //     $('#myInput').on('keyup', function(event) {
                //         event.preventDefault();
                //         //toLowerCase tìm chữ hoa và thường
                //         let key = $(this).val().toLowerCase();
                //         //<tbody id="myTable"> -> tr
                //         $('#myTableP tr').filter(function() {
                //             $(this).toggle($(this).text().toLowerCase().indexOf(key) > -1);
                //         });
                //     });
                // });
            </script>
        @endisset

    @endsection
