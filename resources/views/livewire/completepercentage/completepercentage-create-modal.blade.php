@permission('create-completepercentage')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-completepercentage-modal" data-backdrop="static"
        data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-new-completepercentage-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-completepercentage-modal-label">
                        {{ __('global.create-completepercentage') }}
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
                                    'label' => 'completepercentage.slug',
                                    'name' => 'completepercentage.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'completepercentage.task',
                                    'name' => 'completepercentage.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.select', [
                                    'label' => 'completepercentage.user',
                                    'name' => 'completepercentage.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                @include('inputs.create.input', [
                                    'label' => 'completepercentage.percentage',
                                    'name' => 'completepercentage.percentage',
                                    'livewire' => 'percentage',
                                    'type' => 'number',
                                    'step' => 1,
                                    'min' => 0,
                                    'max' => 100,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @role('owner|manager')
                                    @include('inputs.create.input', [
                                        'label' => 'completepercentage.rate_text',
                                        'name' => 'completepercentage.rate_text',
                                        'livewire' => 'rate_text',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                    @include('inputs.create.input', [
                                        'label' => 'completepercentage.rate_val',
                                        'name' => 'completepercentage.rate_val',
                                        'livewire' => 'rate_val',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                @endrole
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



@permission('edit-completepercentage')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade"
        id="update-completepercentage-modal" tabindex="-1" role="dialog"
        aria-labelledby="update-completepercentage-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-completepercentage-modal-label">
                        {{ $completepercentage->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="completepercentage_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'completepercentage.slug',
                                    'name' => 'completepercentage.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.edit.select', [
                                    'label' => 'completepercentage.task',
                                    'name' => 'completepercentage.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $completepercentage->task_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'completepercentage.user',
                                    'name' => 'completepercentage.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $completepercentage->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.input', [
                                    'label' => 'completepercentage.percentage',
                                    'name' => 'completepercentage.percentage',
                                    'val' => $completepercentage->percentage,
                                    'livewire' => 'percentage',
                                    'type' => 'text',
                                    'type' => 'number',
                                    'step' => 1,
                                    'min' => 0,
                                    'max' => 100,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @role('owner|manager')
                                    @include('inputs.edit.input', [
                                        'label' => 'completepercentage.rate_text',
                                        'name' => 'completepercentage.rate_text',
                                        'val' => $completepercentage->rate_text,
                                        'livewire' => 'rate_text',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                    @include('inputs.edit.input', [
                                        'label' => 'completepercentage.rate_val',
                                        'name' => 'completepercentage.rate_val',
                                        'val' => $completepercentage->rate_val,
                                        'livewire' => 'rate_val',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                @endrole

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
