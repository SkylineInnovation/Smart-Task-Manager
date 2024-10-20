@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('task.index') }}" class="h4">
            {{ __('global.tasks') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <livewire:task.task-index :admin_view_status="$admin_view_status" />
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
