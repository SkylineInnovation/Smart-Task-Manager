<div class="d-flex mb-2">
    <div id="search-sort-section" class="form-inline mr-auto">
        <div>
            <div class="form-group">
                <input wire:model="search" class="form-control" placeholder="{{ __('global.search') }}">
            </div>
        </div>

        <div>
            <select wire:model='orderBy' class="form-control form-group" style="width: 150px;">
                <option value="id">{{ __('global.id') }}</option>

                <option value='user_id'>{{ __('otpsendcode.user') }}</option>

                <option value='otp_code'>{{ __('otpsendcode.otp_code') }}</option>

                <option value='phone_number'>{{ __('otpsendcode.phone_number') }}</option>

                <option value='applecation'>{{ __('otpsendcode.applecation') }}</option>

                <option value='code_status'>{{ __('otpsendcode.code_status') }}</option>

                <option value='back_response'>{{ __('otpsendcode.back_response') }}</option>


                <option value="created_at">{{ __('global.created_at') }}</option>
            </select>
        </div>

        <div>
            <select wire:model="orderWay" class="form-control form-group" style="width: 100px;">
                <option value="asc">{{ __('global.Asc') }}</option>
                <option value="desc">{{ __('global.Desc') }}</option>
            </select>
        </div>

        <div>
            <select wire:model='perPage' class="form-control form-group" style="width: 100px;">
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
                <button type="button" class="mr-1 btn btn-warning" data-toggle="modal"
                    data-target="#filter-otpsendcode-modal">
                    <i class="ti-filter text-white"></i>
                </button>
            </div>
        @endrole
        @role('owner|operations')
            <div>
                <button type="button" class="btn btn-info" data-toggle="modal"
                    data-target="#show-hide-otpsendcode-columnModal">
                    <i class="ti-layout-column4 text-white"></i>
                </button>
            </div>
        @endrole

        @if ($admin_view_status != 'deleted')
            @permission('import-excel-otpsendcode')
                <div>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#import-data">
                        <i class="ti-import text-white"></i>
                    </button>
                </div>
            @endpermission

            @permission('export-excel-otpsendcode')
                <div>
                    <a class="mr-1 btn btn-warning" target="_blank"
                        href="{{ route('otpsendcode.export', ['by_date' => $byDate, 'from_date' => $fromDate, 'to_date' => $toDate]) }}">
                        <i class="ti-export text-white"></i>
                    </a>
                </div>
            @endpermission
        @endif


        @if ($admin_view_status != 'deleted')
            @permission('create-otpsendcode')
                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#create-new-otpsendcode-modal">
                        <i class="ti-plus text-white"></i>
                    </button>
                </div>
            @endpermission
        @endif
    </div>

    <div wire:ignore.self class="modal fade" id="show-hide-otpsendcode-columnModal" tabindex="-1"
        aria-labelledby="show-hide-otpsendcode-columnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-hide-otpsendcode-columnModalLabel">
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

                            @if (strlen(__('otpsendcode.' . $show_kye)) > 2)
                                <div class="form-check">
                                    <input wire:model="showColumn.{{ $kye }}" class="form-check-input"
                                        type="checkbox" value="true" id="filter-otpsendcode-{{ $kye }}">
                                    <label class="form-check-label" for="filter-otpsendcode-{{ $kye }}">
                                        {{ __('otpsendcode.' . $show_kye) }}
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
        @include('livewire.otpsendcode.otpsendcode-create-modal')
    @endif


    @permission('import-excel-otpsendcode')
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

                    <form action="{{ route('otpsendcode.import') }}" enctype="multipart/form-data" method="post"
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


    <div wire:ignore.self class="modal fade" id="filter-otpsendcode-modal" tabindex="-1"
        aria-labelledby="filter-otpsendcode-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filter-otpsendcode-modalLabel">
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


                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info close-btn" data-dismiss="modal">
                        {{ __('global.done') }}
                    </button>

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
