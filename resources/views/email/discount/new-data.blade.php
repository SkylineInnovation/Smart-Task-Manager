@extends('email.layout', [
    'task' => $discount->task,
])

@section('title')
    {{ __('email.there-is-new-discount') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-discount-on-the-task') }}
        </h3>

        <hr>

        <h4>{{ __('discount.user') }}: {{ $discount->user->name() }}</h4>
        <h4>{{ __('discount.amount') }}: {{ $discount->amount }}</h4>
        <h4>{{ __('discount.reason') }}: {{ $discount->reason }}</h4>
    </div>
@endsection
