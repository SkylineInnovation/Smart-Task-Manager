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
    <div class="card">
        <div class="d-flex p-2">
            <div id="search-sort-section" class="form-inline me-auto">
                <div>
                    <div class="form-group">
                        <input wire:model="search" class="form-control" placeholder="{{ __('global.search') }}">
                    </div>
                </div>

                <div>
                    <select wire:model='orderBy' class="form-control form-group">
                        <option value="id">{{ __('global.id') }}</option>

                        <option value='task_id'>{{ __('discount.task') }}</option>

                        <option value='user_id'>{{ __('discount.user') }}</option>

                        <option value='amount'>{{ __('discount.amount') }}</option>

                        <option value='reason'>{{ __('discount.reason') }}</option>


                        <option value="created_at">{{ __('global.created_at') }}</option>
                    </select>
                </div>

                <div>
                    <select wire:model="orderWay" class="form-control form-group">
                        <option value="asc">{{ __('global.Asc') }}</option>
                        <option value="desc">{{ __('global.Desc') }}</option>
                    </select>
                </div>

                <div>
                    <select wire:model='perPage' class="form-control form-group">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <livewire:web.web-create-new-task />
        </div>
    </div>

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
    </script>
@endsection
