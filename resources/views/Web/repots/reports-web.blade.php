@extends('layouts.livewire-app')
<style>
    .mouseHover:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

    .borderColorGreen {
        border-top: #1EAE9A solid 5px
    }

    .borderColorRed {
        border-top: #E04B4A solid 5px
    }
</style>
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


                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center">
                            text
                        </div>
                    </a>
                </div>

            </div>
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
