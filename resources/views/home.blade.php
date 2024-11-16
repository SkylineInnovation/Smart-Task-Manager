@extends('layouts.livewire-app')

<style>
    .mouseHover:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }
</style>

@section('content')
    <div class="container-fluid p-0">
        <div class="row w-100 m-0 ">
            <div class="col-lg-6 p{{ App::getLocale() == 'en' ? 's' : 's' }}-0  col-xl-6 col-md-6 col-sm-12 col-12">
                <div class="card ">
                    <div class="card-header bg-dark text-light">
                        <div class="col-md-12 ">
                            <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'start' }}">
                                {{ __('global.management and control') }}
                            </h4>

                            <small>
                                {{ __('global.system management screens') }}
                            </small>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="row w-100 m-0">
                            @foreach ($mainBtns as $Mbtn)
                                @include('Web.components.main-btn', [
                                    'image' => $Mbtn['image'],
                                    'text' => $Mbtn['text'],
                                ])
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 p{{ App::getLocale() == 'en' ? 'e' : 'e' }}-0 col-xl-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <div class="col-md-12">
                            <h4>
                                {{ __('global.quick_actions') }}
                            </h4>

                            <small>
                                {{ __('global.quick links to access operations for various data') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row w-100 m-0">
                            @foreach ($actionBtns as $actionBtn)
                                @include('Web.components.quick-btn', [
                                    'text' => $actionBtn['text'],
                                ])
                            @endforeach

                        </div>
                    </div>

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
