<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My-Dashbord">
    <meta name="author" content="Mhamad Awwad">
    <meta name="keywords" content="Admin, Web">

    @include('layouts.Components.head')

    <style>
        .show-print {
            display: none !important;
        }

        @media print {
            /* body {
                font-family: Arial, Helvetica, sans-serif;
            } */

            .hidden-print {
                display: none !important;
            }

            .show-print {
                display: block !important;
            }

        }
    </style>

    @livewireStyles

    @yield('css')

</head>

{{-- @if (session('sidenav-toggled') == 'small') sidenav-toggled @endif --}}

<body class="app sidebar-mini main-layout">

    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">


            <div class="container-fluid">
                <div class="side-app">
                    <div class="hidden-print">
                        @include('layouts.Components.top-navbar')
                    </div>

                    @yield('content')


                    @include('layouts.Components.footer')

                </div>

                @include('layouts.Components.footer-scripts')

            </div>

        </div>
    </div>

    @livewireScripts

    @yield('livewire-js')

    <!-- JS IN HERE -->
    @yield('js')


</body>

</html>
