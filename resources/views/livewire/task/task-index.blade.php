<div>

    @include('livewire.task.task-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($tasks->currentPage() - 1) * $perPage;
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <td>#</td> --}}

                    {{-- 
                        @if ($admin_view_status != 'deleted')
                            <td style="width: 75px"> {{ __('global.select') }} </td>
                        @endif
                    --}}

                    @if ($showColumn['id'])
                        <td>{{ __('global.id') }}</td>
                    @endif

                    @if ($showColumn['slug'])
                        <td>{{ __('global.slug') }}</td>
                    @endif


                    @if ($showColumn['manager_id'])
                        <td>{{ __('task.manager') }}</td>
                    @endif

                    @if ($showColumn['employees'])
                        <td>{{ __('task.employees') }}</td>
                    @endif

                    @if ($showColumn['title'])
                        <td>{{ __('task.title') }}</td>
                    @endif

                    @if ($showColumn['desc'])
                        <td>{{ __('task.desc') }}</td>
                    @endif

                    @if ($showColumn['start_time'])
                        <td>{{ __('task.start_time') }}</td>
                    @endif

                    @if ($showColumn['end_time'])
                        <td>{{ __('task.end_time') }}</td>
                    @endif

                    @if ($showColumn['priority_level'])
                        <td>{{ __('task.priority_level') }}</td>
                    @endif

                    @if ($showColumn['status'])
                        <td>{{ __('task.status') }}</td>
                    @endif

                    @if ($showColumn['main_task_id'])
                        <td>{{ __('task.main_task') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-task|delete-task|restore-task')
                        <td style="width: 200px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        {{-- <td>{{ ++$number }}</td> --}}

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedTasks.{{ $task->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $task->id }}" id="task-{{ $task->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $task->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $task->slug }} </td>
                        @endif

                        @if ($showColumn['manager_id'])
                            <td>
                                @if ($task->manager)
                                    {{ $task->manager->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['employees'])
                            <td>
                                @if ($task->employees)
                                    {!! $task->employee_names() !!}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['title'])
                            <td> {{ $task->title }} </td>
                        @endif

                        @if ($showColumn['desc'])
                            <td> {{ $task->desc }} </td>
                        @endif

                        @if ($showColumn['start_time'])
                            <td> {{ $task->format_date($task->start_time) }} </td>
                        @endif

                        @if ($showColumn['end_time'])
                            <td> {{ $task->format_date($task->end_time) }} </td>
                        @endif

                        @if ($showColumn['priority_level'])
                            <td>
                                <span class="dot-label mx-2"
                                    style="background-color: {{ $task->the_priority_color() }};"></span>
                                {{ $task->the_priority_level() }}
                            </td>
                        @endif

                        @if ($showColumn['status'])
                            <td>
                                <span class="dot-label mx-2"
                                    style="background-color: {{ $task->the_status_color() }};"></span>
                                {{ $task->the_status() }}
                                @if ($task->slug)
                                    ({{ $task->slug }})
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['main_task_id'])
                            <td>
                                @if ($task->main_task)
                                    {{ $task->main_task->crud_name() }}
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($task->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($task->created_at)) }} </td>
                        @endif

                        @permission('edit-task|delete-task|restore-task')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('show-task')
                                        <a href="{{ route('task.show', $task) }}" target="_blank" class="btn btn-info">
                                            <i class="ti-eye text-white"></i>
                                        </a>
                                    @endpermission

                                    @permission('edit-task')
                                        <button data-toggle="modal" data-target="#update-task-modal"
                                            wire:click="edit({{ $task->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('edit-task')
                                        <button data-toggle="modal" data-target="#create-new-task-modal"
                                            wire:click="reopen_task({{ $task->id }})" class="btn btn-primary">
                                            <i class="fa fa-refresh text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-task')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-task-{{ $task->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-task-{{ $task->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-task-{{ $task->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-task-{{ $task->id }}-title">
                                                            {{ $task->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-delete') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="delete({{ $task->id }})" class="btn btn-danger"
                                                            data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($admin_view_status == 'deleted')
                                    @permission('restore-task')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-task-{{ $task->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-task-{{ $task->id }}"
                                            aria-labelledby="restore-task-{{ $task->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-task-{{ $task->id }}-title">
                                                            {{ $task->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-restore') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="restore({{ $task->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.restore') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                            </td>
                        @endpermission
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $tasks->links() }}
    </div>
</div>
