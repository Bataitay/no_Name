<div class="tab-content p-3 text-muted">
    <div class="tab-pane active" id="softDelete" role="tabpanel">
        <table role="tabpanel" class="tab-pane table table-bordered dt-responsive nowrap text-center align-middle"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr class="">
                    <th width="15%">Mã sản phẩm</th>
                    <th>Tên sản phẩm(Vi)</th>
                    <th>Tên sản phẩm(En)</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Thời gian cập nhật</th>
                    <th width="20%">Thao tác</th>
            </thead>

            <tbody id="myTable">

                @if ($productSD->count())
                    @foreach ($productSD as $product)
                        <tr class="">


                            <td> {{ $product->id }}</td>
                            <td>{{ $product->nameVi }} </td>
                            <td>{{ $product->nameEn }} </td>
                            <td> {{ $product->quantity }}</td>
                            <td>{{ $product->updated_by }} </td>
                            <td class="action_icon">
                                <div>
                                    @can('Permission forceDelete')
                                        <form action="{{ route('product.restore', $product->id) }}" method="">
                                            @csrf
                                            <button type="submit" class="btn btn-info sm "
                                                onclick="return confirm('do you want restore?')"><i
                                                    class="ri-repeat-fill"></i></button>
                                        </form>
                                    @endcan
                                </div>
                                <div>
                                    @can('Permission restore')
                                        <form action="{{ route('product.forceDelete', $product->id) }}" method="POST ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger sm  "
                                                onclick="return confirm('do you want delete forever?')"><i
                                                    class="fas fa-trash-alt "></i></button>
                                        </form>
                                    @endcan

                                </div>
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>
