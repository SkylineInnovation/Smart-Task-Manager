@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('leave.index') }}" class="h4">
            {{ __('global.leaves') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        {{-- 
            <div class="card-header">
                <h4>{{ __('global.all') }} {{ __('global.leaves') }} </h4>
            </div>
        --}}

        <div class="card-body">
            <livewire:leave.leave-index :admin_view_status="$admin_view_status" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-leave-modal').modal('hide');
                $('#update-leave-modal').modal('hide');

                $('#accept-leave-modal').modal('hide');
            });
        });
    </script>
@endsection
