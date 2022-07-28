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

                <h1>{{ $readed ?? '' }}</h1>
                <h6 class="mt-4">Chat </h6>

                <div class="mt-2">
                    @foreach ($users as $user)
                        @if ($user->id !== auth()->id())
                            @php
                                $notseen =
                                    App\Models\Messager::where('user_id', $user->id)
                                        ->where('receiver_id', auth()->id())
                                        ->where('is_seen', false)
                                        ->get() ?? null;
                            @endphp
                            <a wire:click="getUser({{ $user->id }})" class="d-flex user_name link" href="#">
                                <li class="list-group-item d-flex">
                                    <img class="rounded-circle header-profile-user avatar-chat"
                                    <img src="{{ !empty($user->image) ? asset( $user->image) : asset('uploads/no_image.jpg')}}"
                                        alt="Header Avatar">
                                    <div class="flex-1 chat-user-box overflow-hidden m-2 ">
                                        <p class="user-title m-0">{{ $user->name }}</p>
                                        @if ($user->is_online == true)
                                            <p class=" text-muted text-truncate"><i
                                                    class="ri-compass-4-line rounded-circle  text-success bg-success "></i>Online
                                            </p>
                                        @else
                                            <p class=" text-muted text-truncate">
                                                {{ \Carbon\Carbon::parse($user->last_activity)->diffForHumans() }}</p>
                                        @endif

                                    </div>
                                    <div class="">
                                        @if (filled($notseen))
                                            <div class="badge bg-success rounded count_chat ">
                                                @if ($notseen->count() < 10)
                                                    {{ $notseen->count() }}
                                                @else
                                                    {{ '9+' }}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-inbox"></i></button>
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="fa fa-exclamation-circle"></i></button>
                            <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                    class="far fa-trash-alt"></i></button>
                        </div>
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
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Updates</a>
                                <a class="dropdown-item" href="#">Social</a>
                                <a class="dropdown-item" href="#">Team Manage</a>
                            </div>
                        </div>

                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                More <i class="mdi mdi-dots-vertical ms-2"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Mark as Unread</a>
                                <a class="dropdown-item" href="#">Mark as Important</a>
                                <a class="dropdown-item" href="#">Add to Tasks</a>
                                <a class="dropdown-item" href="#">Add Star</a>
                                <a class="dropdown-item" href="#">Mute</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-4 header-chat " id="">
                            @if (isset($sender))
                                <img class="rounded-circle header-profile-user "
                                <img src="{{ !empty($sender->image) ? asset( $sender->image) : asset('uploads/no_image.jpg')}}"
                                    alt="Header Avatar">
                                <div class="flex-1">
                                    <h5 class="font-size-14 my-1">{{ $sender->name }}</h5>
                                    <div class="active_mgs">
                                        @if ($sender->is_online == true)
                                            <small class="text-muted active_mgs ">Online</small>
                                        @else
                                            <small class="text-muted active_mgs">offline</small>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <img class="rounded-circle header-profile-user avatar-chat"
                                    src="{{ !empty($userMgs->image) ? asset($userMgs->image) : asset('uploads/no_image.jpg') }}"

                                    alt="Header Avatar">
                                <div class="flex-1">
                                    <h5 class="font-size-14 my-1">{{ $userMgs->name }}</h5>
                                    <div class="active_mgs">
                                    </div>

                                </div>
                            @endif

                        </div>
                        <hr />

                        <div class="card-body messager-box box-messager" wire:poll="mountdata">
                            @if (filled($allmessages))
                                @foreach ($allmessages as $mgs)
                                    <div
                                        class="single-messager @if ($mgs->user_id == auth()->id()) sent  @else received @endif">
                                        {{ $mgs->messager }}
                                        <span class="btn-group btn-block justify-content-between mb-0">
                                            <i @if ($mgs->messager !== 'Tin nhắn đã được thu hồi')
                                                 wire:click="recallMessage({{ $mgs->id }}) "
                                                @elseif ($mgs->messager === 'Tin nhắn đã được thu hồi')
                                                wire:click="deleteMessage({{ $mgs->id }})"
                                                @endif
                                                type="button" class="fa fa-trash text-danger icon "></i>
                                        </span>
                                        <br><small
                                            class="text-muted w-100 "><em>{{ $mgs->created_at->format('H:i') }}</em></small>
                                    </div>
                                    @if ($mgs->user_id == auth()->id())
                                    @else
                                        <div class="img_user">
                                            <img class="rounded-circle header-profile-user  "
                                                src="{{ !empty($mgs->user->image) ? url('uploads/admin_img/' . $mgs->user->image) : url('uploads/no_image.jpg') }}"
                                                alt="Header Avatar">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <form wire:submit.prevent="SendMessage">
                            <div class="row height d-flex justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <div class="form">
                                        <i class="fa fa-search"></i>
                                        <input wire:model="messager" type="text" class="form-control form-input">
                                        @error('messager')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
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
