<div class="container chatms">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Read Email</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                        <li class="breadcrumb-item active">Read Email </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card chatbox">
                <button type="button" class="btn btn-danger btn-block waves-effect waves-light" data-bs-toggle="modal"
                    data-bs-target="#composemodal">
                    Tìm Kiếm
                </button>
                <div class="mail-list mt-4">
                    <a href="#" class="active"><i class="mdi mdi-email-outline me-2"></i> Inbox <span
                            class="ms-1 float-end">(18)</span></a>
                    <a href="#"><i class="mdi mdi-trash-can-outline me-2"></i>Trash</a>
                </div>


                <h6 class="mt-4">Chat </h6>

                <div class="mt-2">
                    @foreach ($users as $user)

                            <a wire:click="getUser({{ $user->id }})" class="d-flex user_name link" href="#">
                                <li class="list-group-item d-flex">
                                    <div class="flex-1 chat-user-box overflow-hidden m-2 ">
                                        <p class="user-title m-0">{{ $user->name }}</p>


                                    </div>

                                </li>
                            </a>
                    @endforeach
                </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">

                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Updates</a>
                                <a class="dropdown-item" href="#">Social</a>
                                <a class="dropdown-item" href="#">Team Manage</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-4 header-chat " id="">
                            @if (isset($sender))
                                <div class="flex-1">
                                    <h5 class="font-size-14 my-1">hi{{ $sender->name }}</h5>

                                </div>
                            @endif

                        </div>
                        <hr />

                        <div class="card-body messager-box box-messager" >

                        </div>
                        <form">
                            <div class="row height d-flex justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <div class="form">
                                        <i class="fa fa-search"></i>
                                        <input wire:model="messager" type="text" class="form-control form-input">

                                        <button class="left-pan "><i class="ri-send-plane-2-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- card -->

        </div>
        <!-- end Col-9 -->

    </div>
    <!-- end row -->



</div>
