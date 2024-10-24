<div>

    @include('livewire.attachment.attachment-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($attachments->currentPage() - 1) * $perPage;
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


                    @if ($showColumn['user_id'])
                        <td>{{ __('attachment.user') }}</td>
                    @endif

                    @if ($showColumn['task_id'])
                        <td>{{ __('attachment.task') }}</td>
                    @endif

                    @if ($showColumn['title'])
                        <td>{{ __('attachment.title') }}</td>
                    @endif

                    @if ($showColumn['desc'])
                        <td>{{ __('attachment.desc') }}</td>
                    @endif

                    @if ($showColumn['file'])
                        <td>{{ __('attachment.file') }}</td>
                    @endif

                    @if ($showColumn['main_attachment_id'])
                        <td>{{ __('attachment.main_attachment') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-attachment|delete-attachment|restore-attachment')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($attachments as $attachment)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedAttachments.{{ $attachment->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $attachment->id }}" id="attachment-{{ $attachment->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $attachment->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $attachment->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($attachment->user)
                                    {{ $attachment->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['task_id'])
                            <td>
                                @if ($attachment->task)
                                    {{ $attachment->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['title'])
                            <td> {{ $attachment->title }} </td>
                        @endif

                        @if ($showColumn['desc'])
                            <td> {{ $attachment->desc }} </td>
                        @endif

                        @if ($showColumn['file'])
                            <td>
                                @if ($attachment->file)
                                    <a href="{{ asset($attachment->file) }}" download>download</a>
                                @else
                                    <p>{{ __('attachment.file') }}</p>
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['main_attachment_id'])
                            <td>
                                @if ($attachment->main_attachment)
                                    {{ $attachment->main_attachment->crud_name() }}
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($attachment->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($attachment->created_at)) }} </td>
                        @endif

                        @permission('edit-attachment|delete-attachment|restore-attachment')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-attachment')
                                        <button data-toggle="modal" data-target="#update-attachment-modal"
                                            wire:click="edit({{ $attachment->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-attachment')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-attachment-{{ $attachment->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-attachment-{{ $attachment->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-attachment-{{ $attachment->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-attachment-{{ $attachment->id }}-title">
                                                            {{ $attachment->crud_name() }}
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

                                                        <button wire:click="delete({{ $attachment->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($admin_view_status == 'deleted')
                                    @permission('restore-attachment')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-attachment-{{ $attachment->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-attachment-{{ $attachment->id }}"
                                            aria-labelledby="restore-attachment-{{ $attachment->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-attachment-{{ $attachment->id }}-title">
                                                            {{ $attachment->crud_name() }}
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

                                                        <button wire:click="restore({{ $attachment->id }})"
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

        {{ $attachments->links() }}
    </div>
</div>
