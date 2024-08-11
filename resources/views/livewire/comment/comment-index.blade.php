<div>

    @include('livewire.comment.comment-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($comments->currentPage() - 1) * $perPage;
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
                        <td>{{ __('comment.task') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('comment.user') }}</td>
                    @endif

                    @if ($showColumn['title'])
                        <td>{{ __('comment.title') }}</td>
                    @endif

                    @if ($showColumn['desc'])
                        <td>{{ __('comment.desc') }}</td>
                    @endif

                    @if ($showColumn['replay_time'])
                        <td>{{ __('comment.replay_time') }}</td>
                    @endif

                    @if ($showColumn['main_comment_id'])
                        <td>{{ __('comment.main_comment') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-comment|delete-comment|restore-comment')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedComments.{{ $comment->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $comment->id }}" id="comment-{{ $comment->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $comment->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $comment->slug }} </td>
                        @endif


                        @if ($showColumn['task_id'])
                            <td>
                                @if ($comment->task)
                                    {{ $comment->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($comment->user)
                                    {{ $comment->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['title'])
                            <td> {{ $comment->title }} </td>
                        @endif

                        @if ($showColumn['desc'])
                            <td> {{ $comment->desc }} </td>
                        @endif

                        @if ($showColumn['replay_time'])
                            <td> {{ $comment->replay_time }} </td>
                        @endif

                        @if ($showColumn['main_comment_id'])
                            <td>
                                @if ($comment->main_comment)
                                    {{ $comment->main_comment->crud_name() }}
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($comment->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($comment->created_at)) }} </td>
                        @endif

                        @permission('edit-comment|delete-comment|restore-comment')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-comment')
                                        <button data-toggle="modal" data-target="#update-comment-modal"
                                            wire:click="edit({{ $comment->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-comment')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-comment-{{ $comment->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-comment-{{ $comment->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-comment-{{ $comment->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-comment-{{ $comment->id }}-title">
                                                            {{ $comment->crud_name() }}
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

                                                        <button wire:click="delete({{ $comment->id }})" class="btn btn-danger"
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
                                    @permission('restore-comment')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-comment-{{ $comment->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-comment-{{ $comment->id }}"
                                            aria-labelledby="restore-comment-{{ $comment->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-comment-{{ $comment->id }}-title">
                                                            {{ $comment->crud_name() }}
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

                                                        <button wire:click="restore({{ $comment->id }})"
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

    {{ $comments->links() }}
</div>
