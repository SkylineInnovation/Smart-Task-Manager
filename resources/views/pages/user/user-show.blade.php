@extends('layouts.livewire-index')

@section('content')
    <livewire:user.user-show :user="$user" />

    <div class="card">
        <div class="card-body">
            <livewire:leave.leave-index :user_id="$user->id" />
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <livewire:discount.discount-index :user_id="$user->id" />
        </div>
    </div>
@endsection
