<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('Backend/assets/css/login.css') }}">

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center fw-light fs-5">Đăng ký|Đăng nhập </h5>
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Khách hàng </h5>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInputEmail"
                                    placeholder="name@example.com" required autofocus>
                                <label for="floatingInputEmail">Email address</label>
                            </div>

                            <hr>

                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control" id="floatingPassword"
                                    placeholder="Password"required autocomplete="current-password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid mb-2">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                    type="submit">Login</button>
                            </div>

                            <a class="d-block text-center mt-2 small"href="{{ route('password.request') }}">Have an account? Sign In</a>

                            <hr class="my-4">

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-google btn-login fw-bold text-uppercase" type="submit">
                                    <i class="fab fa-google me-2"></i> Sign up with Google
                                </button>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-facebook btn-login fw-bold text-uppercase" type="submit">
                                    <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
