@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('extratime.index') }}" class="h4">
            {{ __('global.extratimes') }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>
                {{ __('global.the-extratime-has-been') }}:
                <span class="text-danger">{{ __('global.rejected') }}</span>
            </h2>
        </div>
    </div>
@endsection
