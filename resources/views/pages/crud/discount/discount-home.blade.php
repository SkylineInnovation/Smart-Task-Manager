@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('discount.index') }}" class="h4">
            {{ __('global.discounts') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        {{-- 
            <div class="card-header">
                <h4>{{ __('global.all') }} {{ __('global.discounts') }} </h4>
            </div>
        --}}

        <div class="card-body">
            <livewire:discount.discount-index :admin_view_status="$admin_view_status" />
        </div>
    </div>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-discount-modal').modal('hide');
                $('#update-discount-modal').modal('hide');
            });
        });
    </script>
@endsection
