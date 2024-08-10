@extends('layouts.livewire-index')

@section('content')
    <div class="card">
        {{-- 
            <div class="card-header">
                <h4>{{ __('global.all') }} {{ __('global.passwordcodes') }} </h4>
            </div>
        --}}

        <div class="card-body">
            <livewire:passwordcode.passwordcode-index :admin_view_status="$admin_view_status" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-passwordcode-modal').modal('hide');
                $('#update-passwordcode-modal').modal('hide');
            });
        });
    </script>
@endsection
