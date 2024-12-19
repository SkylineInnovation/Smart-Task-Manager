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
        <div class="card-body">
            <h2>
                {{ __('global.the-leave-has-been') }}:
                <span class="text-success">{{ __('global.accepted') }}</span>
            </h2>
        </div>
    </div>
@endsection
