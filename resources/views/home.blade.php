@extends('layouts.livewire-app')


@section('content')
    {{--  --}}

    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-2">
                    <a href="">
                        <img src="{{ asset('assets/dashboard/company.png') }}" width="100%">
                    </a>
                </div>
                <div class="col-2">
                    <a href="">
                        <img src="{{ asset('assets/dashboard/region.png') }}" width="100%">
                    </a>
                </div>
            </div>
        </div>

        {{--  --}}

        <div class="col-6">

        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function() {
            // 
        });
    </script>
@endsection
