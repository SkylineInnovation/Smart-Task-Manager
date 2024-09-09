<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<style>
    .imageBg {
        background-position: center;
        background-repeat: no-repeat;

        background-image: url({{ asset('assets/images/login/maham1-02-04.png') }});
    }

    .posetions {
        position: absolute;
        top: 7%;
        left: 5%;
        width: 50%;
    }

    .inputBg {
        background-color: #00000000 !important;
    }

    .inputBg::placeholder {
        color: #ffffff !important;
    }
</style>

<x-guest-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

    </x-auth-card> --}}

    <div class="container-fluid p-4 imageBg h-100">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/login/maham1-02-03-02.png') }}" width="300" height="300"
                    alt="">
            </div>
            <div class="col-md-8 d-none d-sm-block">
                <img class="posetions" src="{{ asset('assets/images/login/maham1-02-03-03.png') }}" alt="">
            </div>
            <div class="col-md-3  d-flex align-items-center">
                <form method="POST" class="w-100" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class=" justify-content-center">
                        {{-- <x-input-label for="email" :value="__('Email')" /> --}}

                        <x-text-input id="email" class="block mt-1 w-100 rounded-pill inputBg" placeholder="email"
                            type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->

                    <div class="mt-4">
                        {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                        <x-text-input id="password" class="block mt-1 w-100 rounded-pill inputBg"
                            placeholder="password" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center ">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600 text-white">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4 ">
                        {{-- @if (Route::has('password.request'))
                            <a class="underline text-sm text-light"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif --}}

                        <x-primary-button class="ml-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>


</x-guest-layout>
