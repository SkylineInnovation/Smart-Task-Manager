@permission('create-passwordcode')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-passwordcode-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-passwordcode-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-passwordcode-modal-label">
                        {{ __('global.create-passwordcode') }}
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
                                    'label' => 'passwordcode.slug',
                                    'name' => 'passwordcode.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'passwordcode.user',
                                    'name' => 'passwordcode.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'passwordcode.code',
                                    'name' => 'passwordcode.code',
                                    'livewire' => 'code',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'passwordcode.note',
                                    'name' => 'passwordcode.note',
                                    'livewire' => 'note',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'passwordcode.is_used',
                                    'name' => 'passwordcode.is_used',
                                    'livewire' => 'is_used',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'passwordcode.ip_address',
                                    'name' => 'passwordcode.ip_address',
                                    'livewire' => 'ip_address',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                            </div>

                        </div>

                        <div class="form-group">

                            @error('user')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('code')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('note')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('is_used')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('ip_address')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

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



@permission('edit-passwordcode')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-passwordcode-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-passwordcode-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-passwordcode-modal-label">{{ $passwordcode->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="passwordcode_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'passwordcode.slug',
                                    'name' => 'passwordcode.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'passwordcode.user',
                                    'name' => 'passwordcode.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $passwordcode->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'passwordcode.code',
                                    'name' => 'passwordcode.code',
                                    'val' => $passwordcode->code,
                                    'livewire' => 'code',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'passwordcode.note',
                                    'name' => 'passwordcode.note',
                                    'val' => $passwordcode->note,
                                    'livewire' => 'note',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'passwordcode.is_used',
                                    'name' => 'passwordcode.is_used',
                                    'val' => $passwordcode->is_used,
                                    'livewire' => 'is_used',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'passwordcode.ip_address',
                                    'name' => 'passwordcode.ip_address',
                                    'val' => $passwordcode->ip_address,
                                    'livewire' => 'ip_address',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                            </div>

                        </div>

                        <div class="form-group">

                            @error('user')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('code')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('note')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('is_used')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('ip_address')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

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
