@extends('layouts.livewire-app')


@section('css')
    <style>
        .fileupload {
            position: relative;
            overflow: hidden;
            /* and other things to make it pretty */
        }

        .fileupload input {
            position: absolute;
            top: 0;
            right: 0;
            /* not left, because only the right part of the input seems to be clickable in some browser I can't remember */
            cursor: pointer;
            opacity: 0.0;
            filter: alpha(opacity=0);
            /* and all the other old opacity stuff you want to support */
            font-size: 300px;
            /* wtf, but apparently the most reliable way to make a large part of the input clickable in most browsers */
            height: 200px;
        }
    </style>


    {{-- <style>
        .tom-select {
            width: 100% !important;
        }

        .tom-select .ts-control {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .tom-select .ts-dropdown {
            max-height: 250px;
            overflow-y: auto;
        }

        .tom-select .ts-dropdown .custom-option {
            padding: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .tom-select .ts-dropdown .custom-option:hover {
            background-color: #e2e6ea;
        }

        .badge {
            font-size: 0.85rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .custom-option.selected {
            background-color: #007bff;
            color: #fff;
        }

        .ts-control input {
            width: 100% !important;
        }
    </style> --}}
@endsection

@section('content')
    @role('owner|manager')
        <div class="card">
            <div class="d-flex p-2">
                <div id="search-sort-section" class="form-inline me-auto">

                </div>

                <livewire:web.web-create-new-task />

            </div>
        </div>
    @endrole

    <div class="container-fluid card">

        <div class="d-flex flex-row" style="overflow-x: scroll;">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">{{ __('task.Pending') }}</h4>
                <hr style="margin-top:0px !important;">
                <livewire:web.web-get-task-by-status status='pending' />
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">{{ __('task.Active') }}</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='active' />
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">{{ __('task.under-review') }}</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='under-review' />
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">{{ __('task.Finished') }}</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='manual-finished' />
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">{{ __('task.System_Finished') }}</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='auto-finished' />
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // $(function(e) {
        //     $("#summer_desc").summernote({
        //         tabsize: 3,
        //         height: 200,
        //     });
        // });

        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-task').modal('hide');
            });
            window.livewire.on('render-index', () => {
                window.livewire.emit('refreshRender');
            });

            window.livewire.on('render-active', () => {
                window.livewire.emit('refreshRender');
            });

            window.livewire.on('render-manual-finished', () => {
                window.livewire.emit('refreshRender');
            });

            window.livewire.on('close-leave-request-model', id => {
                $('#request-leave-modal-' + id).modal('hide');
            })

            window.livewire.on('close-extra-time-model', id => {
                $('#extra-time-modal-' + id).modal('hide');
            })

            window.livewire.on('close-replay-comment-model', id => {
                $('#replay-modal-' + id).modal('hide');
            })

            window.livewire.on('close-accept-extra-time-model', id => {
                $('#accept-extratime-modal-' + id).modal('hide');
            })
            window.livewire.on('close-accept-leave-model', id => {
                $('#accept-leave-modal-' + id).modal('hide');
            })

            window.livewire.on('close-reject-comment-model', id => {
                $('#reject-task-complete-' + id).modal('hide');
            })
        });
    </script>
@endsection
