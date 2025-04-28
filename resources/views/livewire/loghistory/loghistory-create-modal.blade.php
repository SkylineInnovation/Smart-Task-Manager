@permission('create-loghistory')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-loghistory-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-loghistory-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-loghistory-modal-label">
                        {{ __('global.create-loghistory') }}
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
                                    'label' => 'loghistory.slug',
                                    'name' => 'loghistory.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'loghistory.user',
                                    'name' => 'loghistory.user_id',
                                    'arr' => $users,
                                    'is_select' => false,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 9,
                                    'md' => 9,
                                    'sm' => 9,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'loghistory.action',
                                    'name' => 'loghistory.action',
                                    'livewire' => 'action',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 3,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.by_model_name',
                                    'name' => 'loghistory.by_model_name',
                                    'livewire' => 'by_model_name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.by_model_id',
                                    'name' => 'loghistory.by_model_id',
                                    'livewire' => 'by_model_id',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.on_model_name',
                                    'name' => 'loghistory.on_model_name',
                                    'livewire' => 'on_model_name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.on_model_id',
                                    'name' => 'loghistory.on_model_id',
                                    'livewire' => 'on_model_id',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.from_data',
                                    'name' => 'loghistory.from_data',
                                    'livewire' => 'from_data',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.to_data',
                                    'name' => 'loghistory.to_data',
                                    'livewire' => 'to_data',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'loghistory.preaf',
                                    'name' => 'loghistory.preaf',
                                    'livewire' => 'preaf',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'loghistory.desc',
                                    'name' => 'loghistory.desc',
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'loghistory.color',
                                    'name' => 'loghistory.color',
                                    'livewire' => 'color',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

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



@permission('edit-loghistory')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-loghistory-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-loghistory-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-loghistory-modal-label">{{ $loghistory->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="loghistory_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.slug',
                                    'name' => 'loghistory.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'loghistory.user',
                                    'name' => 'loghistory.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $loghistory->user_id,
                                    'is_select' => false,
                                    'value' => $loghistory->user->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 9,
                                    'md' => 9,
                                    'sm' => 9,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'loghistory.action',
                                    'name' => 'loghistory.action',
                                    'val' => $loghistory->action,
                                    'livewire' => 'action',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 3,
                                ])

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.by_model_name',
                                    'name' => 'loghistory.by_model_name',
                                    'val' => $loghistory->by_model_name,
                                    'livewire' => 'by_model_name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.by_model_id',
                                    'name' => 'loghistory.by_model_id',
                                    'val' => $loghistory->by_model_id,
                                    'livewire' => 'by_model_id',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.on_model_name',
                                    'name' => 'loghistory.on_model_name',
                                    'val' => $loghistory->on_model_name,
                                    'livewire' => 'on_model_name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.on_model_id',
                                    'name' => 'loghistory.on_model_id',
                                    'val' => $loghistory->on_model_id,
                                    'livewire' => 'on_model_id',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.from_data',
                                    'name' => 'loghistory.from_data',
                                    'val' => $loghistory->from_data,
                                    'livewire' => 'from_data',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.to_data',
                                    'name' => 'loghistory.to_data',
                                    'val' => $loghistory->to_data,
                                    'livewire' => 'to_data',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                @include('inputs.edit.input', [
                                    'label' => 'loghistory.preaf',
                                    'name' => 'loghistory.preaf',
                                    'val' => $loghistory->preaf,
                                    'livewire' => 'preaf',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'loghistory.desc',
                                    'name' => 'loghistory.desc',
                                    'val' => $loghistory->desc,
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'loghistory.color',
                                    'name' => 'loghistory.color',
                                    'val' => $loghistory->color,
                                    'livewire' => 'color',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

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
