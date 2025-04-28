@permission('create-attachment')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-attachment-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-attachment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-attachment-modal-label">
                        {{ __('global.create-attachment') }}
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
                                    'label' => 'attachment.slug',
                                    'name' => 'attachment.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'attachment.user',
                                    'name' => 'attachment.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.create.select', [
                                    'label' => 'attachment.task',
                                    'name' => 'attachment.task_id',
                                    'arr' => $tasks,
                                    'is_select' => false,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'attachment.title',
                                    'name' => 'attachment.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'attachment.desc',
                                    'name' => 'attachment.desc',
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'attachment.file',
                                    'name' => 'attachment.file',
                                    'livewire' => 'file',
                                    'type' => 'file', // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'attachment.main_attachment',
                                    'name' => 'attachment.main_attachment_id',
                                    'arr' => $main_attachments,
                                    'is_select' => false,
                                    'livewire' => 'main_attachment_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                            </div>

                            {{-- <div class="row">
                                @if ($file)
                                    <div class="col-3">
                                        <p>Image Preview:</p>
                                        <div class="card" style="width: 100px; height: 100px;">
                                            <img src="{{ $file->temporaryUrl() }}" width="100px" height="100px">
                                        </div>
                                    </div>
                                @endif
                            </div> --}}

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



@permission('edit-attachment')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-attachment-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-attachment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-attachment-modal-label">{{ $attachment->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="attachment_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'attachment.slug',
                                    'name' => 'attachment.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.edit.select', [
                                    'label' => 'attachment.user',
                                    'name' => 'attachment.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $attachment->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.select', [
                                    'label' => 'attachment.task',
                                    'name' => 'attachment.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $attachment->task_id,
                                    'is_select' => false,
                                    'value' => $attachment->task->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'attachment.title',
                                    'name' => 'attachment.title',
                                    'val' => $attachment->title,
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'attachment.desc',
                                    'name' => 'attachment.desc',
                                    'val' => $attachment->desc,
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 6,
                                    'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'attachment.file',
                                    'name' => 'attachment.file',
                                    'val' => $attachment->file,
                                    'livewire' => 'file',
                                    'type' => 'file', // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'attachment.main_attachment',
                                    'name' => 'attachment.main_attachment_id',
                                    'arr' => $main_attachments,
                                    'livewire' => 'main_attachment_id',
                                    'val' => $attachment->main_attachment_id,
                                    'is_select' => false,
                                    'value' => $attachment->main_attachment->crud_name(),
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
