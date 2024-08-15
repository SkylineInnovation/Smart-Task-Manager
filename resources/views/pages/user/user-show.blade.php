@extends('layouts.livewire-index')

@section('content')
    <livewire:user.user-show :user="$user" />

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Leaves</h5>

            <livewire:leave.leave-index :user_id="$user->id" />
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Discounts</h5>

            <livewire:discount.discount-index :user_id="$user->id" />
        </div>
    </div>
@endsection
