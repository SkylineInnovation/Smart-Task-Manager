@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('dailytask.index') }}" class="h4">
            {{ __('global.dailytasks') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        {{-- 
            <div class="card-header">
                <h4>{{ __('global.all') }} {{ __('global.dailytasks') }} </h4>
            </div>
        --}}

        <div class="card-body">
            <livewire:dailytask.dailytask-index :admin_view_status="$admin_view_status" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-dailytask-modal').modal('hide');
                $('#update-dailytask-modal').modal('hide');

                $('#create-new-task-modal').modal('hide');
                $('#update-task-modal').modal('hide');
            });
        });
    </script>
@endsection
