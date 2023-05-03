<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />



    <div class="container ">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                                <div class="col-lg-6 d-none d-lg-block">
                                    <img src="./img/logo-main.jpg" alt="LOGO" class="img-fluid">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                            @if (session('danger'))
                                                <div class="alert alert-danger">
                                                    {{ session('danger') }}
                                                </div>
                                            @endif
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <!-- Email Address -->
                                                <div>
                                                    <x-input-label for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="form-control form-control-user"
                                                        type="email" name="email"
                                                        placeholder="Enter Email Address..." :value="old('email')" required
                                                        autofocus autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <x-input-label for="password" :value="__('Password')" />

                                                <x-text-input id="password" class="form-control form-control-user"
                                                    type="password" name="password" required
                                                    autocomplete="current-password" />

                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <x-primary-button class="btn btn-primary btn-user btn-block">
                                                {{ __('Log in') }}
                                            </x-primary-button>


                                        </form>
                                        <hr>
                                        <div class="text-center mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif


                                        </div>
                                        {{-- <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div> --}}
                                        <div class="text-center">
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="small">Create an
                                                    Account!</a>
                                            @endif
                                            {{-- <a class="small" href="{{ route('password.register') }}">Create an
                                                Account!</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-guest-layout>
