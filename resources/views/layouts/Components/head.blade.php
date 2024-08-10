<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />
{{-- <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png"> --}}

<!-- TITLE -->
<title>{{ config('app.name', 'Laravel') }}</title>


{{-- <script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


<!-- BOOTSTRAP CSS -->
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />

<!--C3 CHARTS CSS -->
<link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

<!-- P-scroll bar css-->
<link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" />

<!--- FONT-ICONS CSS -->
<link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" />

@yield('css')

<!-- SIDE-MENU CSS -->
<link href="{{ asset('assets/css/sidemenu.css') }}" rel="stylesheet" />

<!-- SIDEBAR CSS -->
<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet" />

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet">

{{-- add by laith --}}
<link href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

<link href="{{ URL::asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
