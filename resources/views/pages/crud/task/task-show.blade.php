@extends('layouts.livewire-index')

@section('css')
    <style>
        @media (max-width: 768px) {
            .nav-pills {
                flex-wrap: nowrap;
            }

            .nav-pills .nav-item {
                flex: 0 0 auto;
            }

            .d-flex.overflow-auto {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
@endsection

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('task.index') }}" class="h4">
            {{ __('global.tasks') }}
        </a>
    </li>
@endsection

@section('content')
    <livewire:task.task-show :task="$task" />


    @auth
        <div class="card">
            <div class="card-body">
                <livewire:loghistory.loghistory-index on_model_name="task" :on_model_id="$task->id" />
            </div>
        </div>

    @endauth
@endsection

{{-- @section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-task-modal').modal('hide');
                $('#update-task-modal').modal('hide');
            });
        });
    </script>
@endsection --}}

@section('js')
    <script>
        // $(function(e) {
        //     $("#summer_desc").summernote({
        //         tabsize: 3,
        //         height: 200,
        //     });
        // });

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
        });
    </script>
@endsection
