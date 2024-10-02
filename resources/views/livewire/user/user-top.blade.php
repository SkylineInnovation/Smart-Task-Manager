<div class="d-flex mb-2">
    <div id="search-sort-section" class="form-inline mr-auto">
        <div>
            {{-- <small class="form-text text-muted">{{ __('global.search') }}</small> --}}
            <div class="form-group">
                <input wire:model="search" class="form-control" placeholder="{{ __('global.search') }}">
            </div>
        </div>

        <div>
            {{-- <small class="form-text text-muted">{{ __('global.order-by') }}</small> --}}

            <select wire:model='orderBy' class="form-control form-group">
                <option value="id">{{ __('global.id') }}</option>
                <option value="first_name">{{ __('user.first_name') }}</option>
                <option value="last_name">{{ __('user.last_name') }}</option>
                <option value="user_name">{{ __('user.user_name') }}</option>
                <option value="email">{{ __('user.email') }}</option>
                <option value="phone">{{ __('user.phone') }}</option>
                <option value="gender">{{ __('user.gender') }}</option>
                <option value="birth_day">{{ __('user.birth_day') }}</option>
                <option value="status">{{ __('user.status') }}</option>
                <option value="created_at">{{ __('global.created_at') }}</option>
            </select>
        </div>

        <div>
            {{-- <small class="form-text text-muted">{{ __('global.sort-by') }}</small> --}}
            <select wire:model="order" class="form-control form-group">
                <option value="asc">{{ __('global.Asc') }}</option>
                <option value="desc">{{ __('global.Desc') }}</option>
            </select>
        </div>

        <div>
            {{-- <small class="form-text text-muted">{{ __('global.per-page') }}</small> --}}
            <select wire:model='perPage' class="form-control form-group">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <div>
        {{-- <small class="form-text text-muted">{{ __('global.pop-up') }}</small> --}}

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#show-hide-user-columnModal">
            <i class="ti-layout-column4 text-white"></i>
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-new-user-modal">
            <i class="ti-plus text-white"></i>
        </button>

    </div>

    <div wire:ignore.self class="modal fade" id="show-hide-user-columnModal" tabindex="-1"
        aria-labelledby="show-hide-user-columnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-hide-user-columnModalLabel">
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
                                $val = $showColumn[$kye];
                            @endphp

                            <div class="form-check">
                                <input wire:model="showColumn.{{ $kye }}" class="form-check-input"
                                    type="checkbox" value="true" id="filter-user-{{ $kye }}">
                                <label class="form-check-label" for="filter-user-{{ $kye }}">
                                    {{ __('user.' . $kye) }}
                                </label>
                            </div>
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

    @include('livewire.user.user-create-modal')

</div>
