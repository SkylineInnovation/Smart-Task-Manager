@extends('layouts.livewire-app')@section('css')
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
        </div>
    </div>
</div>

@include('web.repo.new-modal-repo')
@endsection
