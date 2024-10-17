<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<style>
    .imageBg {
        background-position: center;
        background-repeat: no-repeat;

        background-size: 100%;
        background-image: url({{ asset('assets/images/login/login-bg.png') }});
    }

    .posetions {
        position: absolute;
        top: 25%;
        left: 15%;
        /* width: 500px;
        height: 500px; */
        width: 33%;
    }

    .inputBg {
        background-color: #00000000 !important;
    }

    .inputBg::placeholder {
        color: #ffffff !important;
    }
</style>

<x-guest-layout>

    <div class="container-fluid p-4 imageBg h-100">
        <div class="row">
            <div class="col-md-12 d-flex ps-5">
                {{-- <img src="{{ asset('assets/images/login/login-logo.png') }}" style="width: 200px;height: 200px;"> --}}
            </div>
            <div class="col-md-8 d-none d-sm-block">
                {{-- <img class="posetions" src="{{ asset('assets/images/login/login-icon.png') }}"> --}}
            </div>
            <div class="col-md-3  d-flex align-items-center">
                <form method="POST" class="w-100" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class=" justify-content-center">
                        {{-- <x-input-label for="email" :value="__('Email')" /> --}}

                        <x-text-input class="" id="email" class="block mt-1 w-100 rounded-3 inputBg"
                            placeholder="email" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->

                    <div class="mt-4">
                        {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                        <x-text-input id="password" class="block mt-1 w-100 rounded-3 inputBg" placeholder="password"
                            type="password" name="password" required autocomplete="current-password" />
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
