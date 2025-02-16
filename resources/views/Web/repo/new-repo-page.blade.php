@extends('layouts.livewire-app')

@section('css')
    <style>
        .mouseHover:hover {
            drop-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }

        .borderColorGreen {
            border-top: #1EAE9A solid 5px
        }

        .borderColorRed {
            border-top: #E04B4A solid 5px
        }
    </style>
@endsection

@section('content')
    <div class="card ">
        <div class="card-header bg-dark text-light borderColorGreen">
            <div class="col-md-12 ">
                <h4 class="text-{{ App::getLocale() == 'en' ? 'center' : 'center' }}">
                    {{ __('global.reports') }}
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row w-100 m-0">

                {{-- p1-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p1-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p1-r1') }}
                        </div>
                    </a>
                </div>

                {{-- p2-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p2-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p2-r1') }}
                        </div>
                    </a>
                </div>

                {{-- p2-r2 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p2-r2" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p2-r2') }}
                        </div>
                    </a>
                </div>

                {{-- p4-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p4-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p4-r1') }}
                        </div>
                    </a>
                </div>


            </div>
        </div>

    </div>

    <div class="card ">
        <div class="card-header bg-dark text-light borderColorGreen">
            <div class="col-md-12 ">
                <h4 class="text-{{ App::getLocale() == 'en' ? 'center' : 'center' }}">
                    {{ __('global.reports') }}
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row w-100 m-0">

                {{-- p4-r2 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p4-r2" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p4-r2') }}
                        </div>
                    </a>
                </div>

                {{-- p6-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p6-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p6-r1') }}
                        </div>
                    </a>
                </div>

                {{-- p6-r2 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p6-r2" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p6-r2') }}
                        </div>
                    </a>
                </div>

                {{-- p8-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p8-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.repo-p8-r1') }}
                        </div>
                    </a>
                </div>

                {{-- p8-r2 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p8-r2" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.p8-r2') }}
                        </div>
                    </a>
                </div>


                {{-- p10-r1 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p10-r1" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.p10-r1') }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card ">
        <div class="card-header bg-dark text-light borderColorGreen">
            <div class="col-md-12 ">
                <h4 class="text-{{ App::getLocale() == 'en' ? 'center' : 'center' }}">
                    {{ __('global.reports') }}
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row w-100 m-0">
                {{-- P11 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p11" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.p11') }}
                        </div>
                    </a>
                </div>

                {{-- P12 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p12" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.p12') }}
                        </div>
                    </a>
                </div>

                {{-- P13 --}}
                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#repo-p13" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.p13') }}
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>


    @include('web.repo.new-modal-repo')

    {{-- <script>
    function onChangeSearch(event) {
        let input = event.target;
        let options = document.getElementById('customerOptions').options;
        let hiddenInput = document.getElementById('emp_id');

        hiddenInput.value = ''; // Reset hidden input

        for (let option of options) {
            if (option.value === input.value) {
                hiddenInput.value = option.getAttribute('data-value');
                break;
            }
        }
    }
</script>
<script>
    function onChangeSearch(event) {
        let input = event.target;
        let options = document.getElementById('managerOptions').options;
        let hiddenInput = document.getElementById('man_id');

        hiddenInput.value = ''; // Reset hidden input

        for (let option of options) {
            if (option.value === input.value) {
                hiddenInput.value = option.getAttribute('data-value');
                break;
            }
        }
    }
</script>
<script>
    function onChangeSearch(event) {
        let input = event.target;
        let options = document.getElementById('employeesP8R1Options').options;
        let hiddenInput = document.getElementById('employeesP8R1_id');

        hiddenInput.value = ''; // Reset hidden input

        for (let option of options) {
            if (option.value === input.value) {
                hiddenInput.value = option.getAttribute('data-value');
                break;
            }
        }
    }
</script> --}}

    <script>
        function onChangeSearch(event, dataListId, hiddenInputId) {
            let input = event.target.value;
            let options = document.getElementById(dataListId).options;
            let hiddenInput = document.getElementById(hiddenInputId);

            hiddenInput.value = ''; // Reset hidden input

            for (let option of options) {
                if (option.value === input) {
                    hiddenInput.value = option.getAttribute('data-value');
                    break;
                }
            }
        }
    </script>
@endsection
