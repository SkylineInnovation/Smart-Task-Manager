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

    @livewireStyles

    @stack('styles')

    @yield('css')

</head>

<body class="app sidebar-mini @if (session('sidenav-toggled') == 'small') sidenav-toggled @endif">

    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>


    <div class="page">
        <div class="page-main">

            @include('layouts.Components.mobile-header')


            <div class="">
                <div class="container-fluid">

                    <div class="page-header">

                        <div>
                            <h1 class="page-title">{{ __('global.dashboard') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">{{ __('global.home') }}</a>
                                </li>
                                @yield('page-header')
                            </ol>
                        </div>

                        @include('layouts.Components.notification')

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>
                                Task Not Found
                            </h3>
                        </div>
                        <div class="card-body">
                            <h2>
                                Sorry cant open the task
                            </h2>
                        </div>
                    </div>


                    @include('layouts.Components.footer')

                </div>

                @include('layouts.Components.footer-scripts')

            </div>

        </div>
    </div>

    @livewireScripts

    @stack('scripts')

    @yield('livewire-js')

    @yield('js')

</body>

</html>
