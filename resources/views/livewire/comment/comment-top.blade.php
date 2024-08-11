<div class="d-flex mb-2">
    <div id="search-sort-section" class="form-inline mr-auto">
        <div>
            <div class="form-group">
                <input wire:model="search" class="form-control" placeholder="{{ __('global.search') }}">
            </div>
        </div>

        <div>
            <select wire:model='orderBy' class="form-control form-group">
                <option value="id">{{ __('global.id') }}</option>

                <option value='task_id'>{{ __('comment.task') }}</option>

                <option value='user_id'>{{ __('comment.user') }}</option>

                <option value='title'>{{ __('comment.title') }}</option>

                <option value='desc'>{{ __('comment.desc') }}</option>

                <option value='replay_time'>{{ __('comment.replay_time') }}</option>

                <option value='main_comment_id'>{{ __('comment.main_comment') }}</option>


                <option value="created_at">{{ __('global.created_at') }}</option>
            </select>
        </div>

        <div>
            <select wire:model="orderWay" class="form-control form-group">
                <option value="asc">{{ __('global.Asc') }}</option>
                <option value="desc">{{ __('global.Desc') }}</option>
            </select>
        </div>

        <div>
            <select wire:model='perPage' class="form-control form-group">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <div class="form-inline">
        @role('owner|operations')
            <div>
                <button type="button" class="mr-1 btn btn-warning" data-toggle="modal" data-target="#filter-comment-modal">
                    <i class="ti-filter text-white"></i>
                </button>
            </div>
        @endrole
        @role('owner|operations')
            <div>
                <button type="button" class="btn btn-info" data-toggle="modal"
                    data-target="#show-hide-comment-columnModal">
                    <i class="ti-layout-column4 text-white"></i>
                </button>
            </div>
        @endrole

        @if ($admin_view_status != 'deleted')
            @permission('import-excel-comment')
                <div>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#import-data">
                        <i class="ti-import text-white"></i>
                    </button>
                </div>
            @endpermission

            @permission('export-excel-comment')
                <div>
                    <a class="mr-1 btn btn-warning" target="_blank"
                        href="{{ route('comment.export', ['by_date' => $byDate, 'from_date' => $fromDate, 'to_date' => $toDate]) }}">
                        <i class="ti-export text-white"></i>
                    </a>
                </div>
            @endpermission
        @endif


        @if ($admin_view_status != 'deleted')
            @permission('create-comment')
                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#create-new-comment-modal">
                        <i class="ti-plus text-white"></i>
                    </button>
                </div>
            @endpermission
        @endif
    </div>

    <div wire:ignore.self class="modal fade" id="show-hide-comment-columnModal" tabindex="-1"
        aria-labelledby="show-hide-comment-columnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-hide-comment-columnModalLabel">
                        {{ __('global.show-and-hide-table-columns') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>

                        @for ($i = 0; $i < count($showColumn); $i++)
                            @php
                                $kye = $showColumn->keys()[$i];
                                $show_kye = str_replace('_id', '', $kye);
                            @endphp

                            @if (strlen(__('comment.' . $show_kye)) > 2)
                                <div class="form-check">
                                    <input wire:model="showColumn.{{ $kye }}" class="form-check-input"
                                        type="checkbox" value="true" id="filter-comment-{{ $kye }}">
                                    <label class="form-check-label" for="filter-comment-{{ $kye }}">
                                        {{ __('comment.' . $show_kye) }}
                                    </label>
                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('global.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if ($admin_view_status != 'deleted')
        @include('livewire.comment.comment-create-modal')
    @endif


    @permission('import-excel-comment')
        <div wire:ignore.self class="modal fade" id="import-data" tabindex="-1" aria-labelledby="import-dataLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="import-dataLabel">
                            {{ __('global.import_excel') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('comment.import') }}" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8" class="form-horizontal m-t-30">
                        <div class="modal-body">
                            @csrf

                            <div class="p-2 text-white" style="background-color: red">
                                <h4>
                                    {{ __('global.Please make sure') }}
                                </h4>
                            </div>
                            <div class="row">
                                @include('inputs.create.input', [
                                    'label' => '',
                                    'name' => 'excel_file',
                                    'type' => 'file',
                                    'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                    'extra' => "accept='.csv'",
                                ])

                                @role('owner|operations')
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="import_type">{{ __('global.import_type') }}</label>
                                            <select name="import_type" id="import_type" class="form-control" required>
                                                <option value="stander" selected>{{ __('global.stander') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endrole
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                                {{ __('global.close') }}
                            </button>
                            <button type="submit" class="btn btn-success close-modal">
                                {{ __('global.save-changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpermission


    <div wire:ignore.self class="modal fade" id="filter-comment-modal" tabindex="-1"
        aria-labelledby="filter-comment-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filter-comment-modalLabel">
                        {{ __('global.filter') }}
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-inline">
                        <div>
                            {{-- <small class="form-text text-muted">{{ __('global.search_by_date') }}</small> --}}
                            <label for="user-select">{{ __('global.by_date') }}</label>
                            <div class="form-group">
                                <input type="date" wire:model="fromDate" class="form-control mr-1">
                                <input type="date" wire:model="toDate" class="form-control mr-1">

                                <select wire:model="byDate" class="form-control form-group">
                                    <option value="created_at">{{ __('global.created date time') }}</option>
                                    <option value="updated_at">{{ __('global.updated date time') }}</option>

                                    @if ($admin_view_status == 'deleted')
                                        <option value="deleted_at">{{ __('global.deleted date time') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- @role('owner|admin')
                        <div class="form-group">
                            <label for="user-select">{{ __('global.by_users') }}</label>
                            <select id="user-select" class="form-control" wire:model='select_user'>
                                <option>{{ __('global.Select-One-Multiple') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->crud_name() }}</option>
                                @endforeach
                            </select>

                            @foreach ($users as $user)
                                @if (in_array($user->id, $filter_users_ids))
                                    <div class="form-check form-check-inline">
                                        <input wire:model='filter_users_ids' class="form-check-input" type="checkbox"
                                            value="{{ $user->id }}" id="filter-user-ids-{{ $user->id }}">
                                        <label class="form-check-label" for="filter-user-ids-{{ $user->id }}">
                                            {{ $user->crud_name() }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endrole --}}


                    <div class='form-group'>
                        <label for='task-select'>{{ __('global.by_tasks') }}</label>
                        <select id='task-select' class='form-control' wire:model='select_task'>
                            <option>Select tasks</option>
                            @foreach ($tasks as $task)
                                <option value='{{ $task->id }}'>{{ $task->crud_name() }}</option>
                            @endforeach
                        </select>

                        @foreach ($tasks as $task)
                            @if (in_array($task->id, $filter_tasks_id))
                                <div class='form-check form-check-inline'>
                                    <input wire:model='filter_tasks_id' class='form-check-input' type='checkbox'
                                        value='{{ $task->id }}' id='filter-tasks-id-{{ $task->id }}'>
                                    <label class='form-check-label' for='filter-tasks-id-{{ $task->id }}'>
                                        {{ $task->crud_name() }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class='form-group'>
                        <label for='user-select'>{{ __('global.by_users') }}</label>
                        <select id='user-select' class='form-control' wire:model='select_user'>
                            <option>Select users</option>
                            @foreach ($users as $user)
                                <option value='{{ $user->id }}'>{{ $user->crud_name() }}</option>
                            @endforeach
                        </select>

                        @foreach ($users as $user)
                            @if (in_array($user->id, $filter_users_id))
                                <div class='form-check form-check-inline'>
                                    <input wire:model='filter_users_id' class='form-check-input' type='checkbox'
                                        value='{{ $user->id }}' id='filter-users-id-{{ $user->id }}'>
                                    <label class='form-check-label' for='filter-users-id-{{ $user->id }}'>
                                        {{ $user->crud_name() }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class='form-group'>
                        <label for='main_comment-select'>{{ __('global.by_main_comments') }}</label>
                        <select id='main_comment-select' class='form-control' wire:model='select_main_comment'>
                            <option>Select main_comments</option>
                            @foreach ($main_comments as $main_comment)
                                <option value='{{ $main_comment->id }}'>{{ $main_comment->crud_name() }}</option>
                            @endforeach
                        </select>

                        @foreach ($main_comments as $main_comment)
                            @if (in_array($main_comment->id, $filter_main_comments_id))
                                <div class='form-check form-check-inline'>
                                    <input wire:model='filter_main_comments_id' class='form-check-input'
                                        type='checkbox' value='{{ $main_comment->id }}'
                                        id='filter-main_comments-id-{{ $main_comment->id }}'>
                                    <label class='form-check-label'
                                        for='filter-main_comments-id-{{ $main_comment->id }}'>
                                        {{ $main_comment->crud_name() }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>


                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" wire:click.prevent="clearFilter()">
                        {{ __('global.clear') }}
                    </button>
                    {{-- 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    --}}
                </div>
            </div>
        </div>
    </div>
</div>
