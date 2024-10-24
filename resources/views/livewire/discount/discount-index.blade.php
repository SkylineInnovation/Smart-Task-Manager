<div>

    @include('livewire.discount.discount-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($discounts->currentPage() - 1) * $perPage;
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>

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


                    @if ($showColumn['task_id'])
                        <td>{{ __('discount.task') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('discount.user') }}</td>
                    @endif

                    @if ($showColumn['amount'])
                        <td>{{ __('discount.amount') }}</td>
                    @endif

                    @if ($showColumn['reason'])
                        <td>{{ __('discount.reason') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-discount|delete-discount|restore-discount')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedDiscounts.{{ $discount->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $discount->id }}" id="discount-{{ $discount->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $discount->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $discount->slug }} </td>
                        @endif


                        @if ($showColumn['task_id'])
                            <td>
                                @if ($discount->task)
                                    {{ $discount->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($discount->user)
                                    {{ $discount->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['amount'])
                            <td> {{ $discount->amount }} </td>
                        @endif

                        @if ($showColumn['reason'])
                            <td> {{ $discount->reason }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($discount->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($discount->created_at)) }} </td>
                        @endif

                        @permission('edit-discount|delete-discount|restore-discount')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-discount')
                                        <button data-toggle="modal" data-target="#update-discount-modal"
                                            wire:click="edit({{ $discount->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-discount')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-discount-{{ $discount->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-discount-{{ $discount->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-discount-{{ $discount->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-discount-{{ $discount->id }}-title">
                                                            {{ $discount->crud_name() }}
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

                                                        <button wire:click="delete({{ $discount->id }})" class="btn btn-danger"
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
                                    @permission('restore-discount')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-discount-{{ $discount->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-discount-{{ $discount->id }}"
                                            aria-labelledby="restore-discount-{{ $discount->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-discount-{{ $discount->id }}-title">
                                                            {{ $discount->crud_name() }}
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

                                                        <button wire:click="restore({{ $discount->id }})"
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

        {{ $discounts->links() }}
    </div>
</div>
