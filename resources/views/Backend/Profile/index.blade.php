@extends('Backend.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <table>
                    <tr>
                        <th class="col-lg-4">
                            <center>
                                <img class="w-100"
                                    src="{{ !empty($user->image) ? url('uploads/admin_img/' . $user->image) : url('uploads/no_image.jpg') }}"
                                    alt="Card image cap">
                            </center>
                        </th>
                        <th class="col-lg-8">
                            <div class="card-body">
                                <h4 class="card-title">Họ và tên : {{ $user->username }} </h4>
                                <hr>
                                <h4 class="card-title">E-mail : {{ $user->email }} </h4>
                                <hr>
                                <h4 class="card-title">Số điện thoại : {{ $user->phone }} </h4>
                                <hr>
                                <h4 class="card-title">Địa chỉ : {{ $user->address }}-{{ $ward->name }}-{{ $district->name }}-{{ $province->name }} </h4>
                                <hr>
                                <h4 class="card-title">Ngày bắt đầu : {{ $user->start_day }} </h4>
                                <hr>
                                <h4 class="card-title">Ghi chú : {{ $user->note }} </h4>
                                <hr>
                                <a href="{{ route('admin.storeprofile') }}"
                                    class="btn btn-info btn-rounded waves-effect waves-light"> Edit Profile</a>

                            </div>
                        </th>
                    </tr>
                </table>



            </div>


        </div>
    </div>
@endsection
