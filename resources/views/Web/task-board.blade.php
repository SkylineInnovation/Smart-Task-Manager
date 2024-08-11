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
            <div class="col-md-4 py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">Pending</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='pending' />
            </div>

            <div class="col-md-4 text-center py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">Active</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='active' />
            </div>

            <div class="col-md-4 text-center py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">Finished</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='manual-finished' />
            </div>

            <div class="col-md-4 text-center py-4">
                <h4 class="p-0 text-gray-400 fw-bold text-center">System Finished</h4>
                <hr style="margin-top:0px !important;">

                <livewire:web.web-get-task-by-status status='auto-finished' />
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(e) {
            $("#summer_desc").summernote({
                tabsize: 3,
                height: 200,
            });
        });

        $(document).ready(function() {
            window.livewire.on('render-index', () => {
                window.livewire.emit('refreshRender');
            });

            window.livewire.on('render-active', () => {
                window.livewire.emit('refreshRender');
            });

            window.livewire.on('render-manual-finished', () => {
                window.livewire.emit('refreshRender');
            });
        });
    </script>
@endsection
