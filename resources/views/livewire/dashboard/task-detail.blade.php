<div>
    {{-- Success is as dangerous as failure. --}}

    <a href="{{ route('task.show', $task) }}" class="row w-100 m-0  py-3 bgHover">
        {{-- data-toggle="modal" data-target="#exampleModalCenter{{ $rand }}" --}}
        <div class="col-md-2 col-2 d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/dashboard/task.png') }}" width="60px" height="60px" alt="">
        </div>

        <div class="col-md-10 col-9">
            <h3 class="mb-3">{{ $task->title }}</h3>
            <p class="pb-0 mb-0">{{ __('global.task-number') }} :
                {{ $task->id }}
            </p>
            {{--  --}}
            <p class="pb-0 mb-0">{{ __('global.task-manager') }} :
                {{ $task->manager->name() }}
            </p>
            {{--  --}}
            <p class="pb-0 mb-0">{{ __('global.employees') }} :
                {!! $task->employee_names() !!}
            </p>
        </div>
    </a>


    {{-- @include('web.task.task-modal', [
        'loop' => $rand,
        'taskID' => $task->id,
        'value' => $task,
    ]) --}}
</div>
