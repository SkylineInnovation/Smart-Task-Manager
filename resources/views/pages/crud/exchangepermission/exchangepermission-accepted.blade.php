@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('exchangepermission.index') }}" class="h4">
            {{ __('global.exchangepermissions') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>
                {{ __('global.the-exchange-permission-has-been') }}
                <span class="text-success">{{ __('global.accepted') }}</span>
            </h2>
        </div>
    </div>
@endsection
