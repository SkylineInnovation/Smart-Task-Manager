@extends('layouts.livewire-index')

@section('page-header')
    <li class="breadcrumb-item">
        <a href="{{ route('user.index') }}" class="h4">
            {{ __('global.users') }}
        </a>
    </li>
@endsection

@section('content')
    <livewire:user.user-show :user="$user" />

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('global.tasks') }}</h5>

            <livewire:task.task-index :the_employee_id="$user->id" />
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('global.leaves') }}</h5>

            <livewire:leave.leave-index :user_id="$user->id" />
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('global.discounts') }}</h5>

            <livewire:discount.discount-index :user_id="$user->id" />
        </div>
    </div>
@endsection
