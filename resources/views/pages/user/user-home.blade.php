@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('user.index') }}" class="h4">
            {{ __('global.users') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <livewire:user.user-index />
        </div>
        {{-- <div class="card-footer">
        Footer
    </div> --}}
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-user-modal').modal('hide');
                $('#update-user-modal').modal('hide');
            });
        });
    </script>
@endsection
