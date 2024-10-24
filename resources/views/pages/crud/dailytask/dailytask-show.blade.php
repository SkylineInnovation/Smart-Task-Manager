@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('dailytask.index') }}" class="h4">
            {{ __('global.dailytasks') }}
        </a>
    </li>
@endsection

@section('content')
    <livewire:dailytask.daily-task-show :dailytask="$dailytask" />

    <div class="card">
        <div class="card-header">
            {{ __('global.automation tasks') }}
        </div>
        <div class="card-body">
            <livewire:task.task-index :dailytask="$dailytask" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {

                $('#create-new-task-modal').modal('hide');
                $('#update-task-modal').modal('hide');
            });
        });
    </script>
@endsection
