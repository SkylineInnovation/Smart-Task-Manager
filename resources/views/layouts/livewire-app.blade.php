<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My-Dashbord">
    <meta name="author" content="Codexal">
    <meta name="keywords" content="Admin, Web">

    @include('layouts.Components.head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">


    @livewireStyles

    @stack('styles')

    @yield('css')

</head>

<body class="app sidebar-mini @if (session('sidenav-toggled') == 'small') sidenav-toggled @endif">

    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    @php
        $show_side = $show_side ?? auth()->user()->hasRole('owner') && auth()->user()->hasRole('dev');
        // $show_side = $show_side ?? auth()->user()->hasRole('owner');
        // $show_side = true;
    @endphp

    <div class="page">
        <div class="page-main">

            @if ($show_side)
                @include('layouts.Components.app-sidebar')
            @endif

            @include('layouts.Components.mobile-header')


            <div class="@if ($show_side) app-content @endif">
                <div class="@if ($show_side) side-app @else container-fluid @endif">

                    {{--  --}}{{--  --}}{{--  --}}{{--  --}}
                    @include('layouts.Components.top-navbar')
                    {{--  --}}{{--  --}}{{--  --}}{{--  --}}

                    <div class="page-header">

                        <div>
                            <h1 class="page-title">{{ __('global.dashboard') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <h4>{{ __('global.home') }}</h4>
                                    </a>
                                </li>
                                @yield('page-header')
                            </ol>
                        </div>

                        @include('layouts.Components.notification')

                    </div>

                    {{-- <div class="card">
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div> --}}

                    {{-- <div class="card">
                        <div class="card-body"> --}}

                    @yield('content')

                    {{-- </div>
                    </div> --}}


                    @include('layouts.Components.footer')

                </div>

                @include('layouts.Components.footer-scripts')

            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    @livewireScripts

    @stack('scripts')

    @yield('livewire-js')

    @yield('js')

    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left zindex",
        };

        @if (App::getLocale() == 'ar')
            toastr.options.positionClass = "toast-bottom-right";
        @endif


        $(document).ready(function() {

            Livewire.on('show-message', data => {
                console.log("message -> " + data['message']);

                toastr.success(data['message']);
            });
        });
    </script>

</body>

</html>
