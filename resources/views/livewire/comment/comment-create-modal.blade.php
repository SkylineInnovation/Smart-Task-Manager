@permission('create-comment')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-comment-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-comment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-comment-modal-label">
                        {{ __('global.create-comment') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if (!$updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.create.input', [
                                    'label' => 'comment.slug',
                                    'name' => 'comment.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'comment.task',
                                    'name' => 'comment.task_id',
                                    'arr' => $tasks,
                                    'is_select' => false,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'comment.user',
                                    'name' => 'comment.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'comment.title',
                                    'name' => 'comment.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'comment.desc',
                                    'name' => 'comment.desc',
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'comment.replay_time',
                                    'name' => 'comment.replay_time',
                                    'livewire' => 'replay_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.create.select', [
                                    'label' => 'comment.main_comment',
                                    'name' => 'comment.main_comment_id',
                                    'arr' => $main_comments,
                                    'is_select' => false,
                                    'livewire' => 'main_comment_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                            </div>

                        </div>

                        <div class="form-group">

                            @foreach ($errors->all() as $error)
                                <span class='alert alert-danger btn'>{{ $error }}</span>
                            @endforeach

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                                {{ __('global.close') }}
                            </button>
                            <button type="submit" wire:click.prevent="store()" class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endpermission



@permission('edit-comment')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-comment-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-comment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-comment-modal-label">{{ $comment->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="comment_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'comment.slug',
                                    'name' => 'comment.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'comment.task',
                                    'name' => 'comment.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $comment->task_id,
                                    'is_select' => false,
                                    'value' => $comment->task->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'comment.user',
                                    'name' => 'comment.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $comment->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'comment.title',
                                    'name' => 'comment.title',
                                    'val' => $comment->title,
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}
                                @include('inputs.edit.input', [
                                    'label' => 'comment.desc',
                                    'name' => 'comment.desc',
                                    'val' => $comment->desc,
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'comment.replay_time',
                                    'name' => 'comment.replay_time',
                                    'val' => $comment->replay_time,
                                    'livewire' => 'replay_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.select', [
                                    'label' => 'comment.main_comment',
                                    'name' => 'comment.main_comment_id',
                                    'arr' => $main_comments,
                                    'livewire' => 'main_comment_id',
                                    'val' => $comment->main_comment_id,
                                    'is_select' => false,
                                    'value' => $comment->main_comment->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                            </div>

                        </div>

                        <div class="form-group">

                            @foreach ($errors->all() as $error)
                                <span class='alert alert-danger btn'>{{ $error }}</span>
                            @endforeach

                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn"
                                data-dismiss="modal">{{ __('global.close') }}</button>
                            <button type="button" wire:click.prevent="update()" class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endpermission
