@extends('layouts.livewire-index')

@section('content')
    <livewire:dailytask.daily-task-show :dailytask="$dailytask" />

    <div class="card">
        <div class="card-header">
            {{ __('global.automation tasks') }}
        </div>
        <div class="card-body">
            <livewire:task.task-index :dailytask="$dailytask" />
        </div>
    </div>
@endsection
