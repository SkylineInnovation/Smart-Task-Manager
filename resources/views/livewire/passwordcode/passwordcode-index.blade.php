<div>

    @include('livewire.passwordcode.passwordcode-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($passwordcodes->currentPage() - 1) * $perPage;
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>

                    {{-- 
                        @if ($status != 'deleted')
                            <td style="width: 75px"> {{ __('global.select') }} </td>
                        @endif
                    --}}

                    @if ($showColumn['id'])
                        <td>{{ __('global.id') }}</td>
                    @endif

                    @if ($showColumn['slug'])
                        <td>{{ __('global.slug') }}</td>
                    @endif


                    @if ($showColumn['user_id'])
                        <td>{{ __('passwordcode.user') }}</td>
                    @endif

                    @if ($showColumn['code'])
                        <td>{{ __('passwordcode.code') }}</td>
                    @endif

                    @if ($showColumn['note'])
                        <td>{{ __('passwordcode.note') }}</td>
                    @endif

                    @if ($showColumn['is_used'])
                        <td>{{ __('passwordcode.is_used') }}</td>
                    @endif

                    @if ($showColumn['ip_address'])
                        <td>{{ __('passwordcode.ip_address') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-passwordcode|delete-passwordcode|restore-passwordcode')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($passwordcodes as $passwordcode)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedPasswordcodes.{{ $passwordcode->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $passwordcode->id }}" id="passwordcode-{{ $passwordcode->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $passwordcode->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $passwordcode->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($passwordcode->user)
                                    {{ $passwordcode->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['code'])
                            <td> {{ $passwordcode->code }} </td>
                        @endif

                        @if ($showColumn['note'])
                            <td> {{ $passwordcode->note }} </td>
                        @endif

                        @if ($showColumn['is_used'])
                            <td> {{ $passwordcode->is_used }} </td>
                        @endif

                        @if ($showColumn['ip_address'])
                            <td> {{ $passwordcode->ip_address }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($passwordcode->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($passwordcode->created_at)) }} </td>
                        @endif

                        @permission('edit-passwordcode|delete-passwordcode|restore-passwordcode')
                            <td>
                                @if ($status != 'deleted')
                                    @permission('edit-passwordcode')
                                        <button data-toggle="modal" data-target="#update-passwordcode-modal"
                                            wire:click="edit({{ $passwordcode->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-passwordcode')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-passwordcode-{{ $passwordcode->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-passwordcode-{{ $passwordcode->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-passwordcode-{{ $passwordcode->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-passwordcode-{{ $passwordcode->id }}-title">
                                                            {{ $passwordcode->crud_name() }}
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

                                                        <button wire:click="delete({{ $passwordcode->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($status == 'deleted')
                                    @permission('restore-passwordcode')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-passwordcode-{{ $passwordcode->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-passwordcode-{{ $passwordcode->id }}"
                                            aria-labelledby="restore-passwordcode-{{ $passwordcode->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-passwordcode-{{ $passwordcode->id }}-title">
                                                            {{ $passwordcode->crud_name() }}
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

                                                        <button wire:click="restore({{ $passwordcode->id }})"
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
    </div>

    {{ $passwordcodes->links() }}
</div>
