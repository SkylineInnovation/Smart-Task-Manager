<div>

    @include('livewire.otpsendcode.otpsendcode-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($otpsendcodes->currentPage() - 1) * $perPage;
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
                        <td>{{ __('otpsendcode.user') }}</td>
                    @endif

                    @if ($showColumn['otp_code'])
                        <td>{{ __('otpsendcode.otp_code') }}</td>
                    @endif

                    @if ($showColumn['phone_number'])
                        <td>{{ __('otpsendcode.phone_number') }}</td>
                    @endif

                    @if ($showColumn['applecation'])
                        <td>{{ __('otpsendcode.applecation') }}</td>
                    @endif

                    @if ($showColumn['code_status'])
                        <td>{{ __('otpsendcode.code_status') }}</td>
                    @endif

                    @if ($showColumn['back_response'])
                        <td>{{ __('otpsendcode.back_response') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-otpsendcode|delete-otpsendcode|restore-otpsendcode')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($otpsendcodes as $otpsendcode)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedOtpsendcodes.{{ $otpsendcode->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $otpsendcode->id }}" id="otpsendcode-{{ $otpsendcode->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $otpsendcode->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $otpsendcode->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($otpsendcode->user)
                                    {{ $otpsendcode->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['otp_code'])
                            <td> {{ $otpsendcode->otp_code }} </td>
                        @endif

                        @if ($showColumn['phone_number'])
                            <td> {{ $otpsendcode->phone_number }} </td>
                        @endif

                        @if ($showColumn['applecation'])
                            <td> {{ $otpsendcode->applecation }} </td>
                        @endif

                        @if ($showColumn['code_status'])
                            <td> {{ $otpsendcode->code_status }} </td>
                        @endif

                        @if ($showColumn['back_response'])
                            <td> {{ $otpsendcode->back_response }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($otpsendcode->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($otpsendcode->created_at)) }} </td>
                        @endif

                        @permission('edit-otpsendcode|delete-otpsendcode|restore-otpsendcode')
                            <td>
                                @if ($status != 'deleted')
                                    @permission('edit-otpsendcode')
                                        <button data-toggle="modal" data-target="#update-otpsendcode-modal"
                                            wire:click="edit({{ $otpsendcode->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-otpsendcode')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-otpsendcode-{{ $otpsendcode->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-otpsendcode-{{ $otpsendcode->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-otpsendcode-{{ $otpsendcode->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-otpsendcode-{{ $otpsendcode->id }}-title">
                                                            {{ $otpsendcode->crud_name() }}
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

                                                        <button wire:click="delete({{ $otpsendcode->id }})"
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
                                    @permission('restore-otpsendcode')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-otpsendcode-{{ $otpsendcode->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-otpsendcode-{{ $otpsendcode->id }}"
                                            aria-labelledby="restore-otpsendcode-{{ $otpsendcode->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-otpsendcode-{{ $otpsendcode->id }}-title">
                                                            {{ $otpsendcode->crud_name() }}
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

                                                        <button wire:click="restore({{ $otpsendcode->id }})"
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

    {{ $otpsendcodes->links() }}
</div>
