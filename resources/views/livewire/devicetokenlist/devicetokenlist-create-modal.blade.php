@permission('create-devicetokenlist')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-devicetokenlist-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-devicetokenlist-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-devicetokenlist-modal-label">
                        {{ __('global.create-devicetokenlist') }}
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
                                    'label' => 'devicetokenlist.slug',
                                    'name' => 'devicetokenlist.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'devicetokenlist.user',
                                    'name' => 'devicetokenlist.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'devicetokenlist.device_info',
                                    'name' => 'devicetokenlist.device_info',
                                    'livewire' => 'device_info',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'devicetokenlist.device_type',
                                    'name' => 'devicetokenlist.device_type',
                                    'livewire' => 'device_type',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'devicetokenlist.application',
                                    'name' => 'devicetokenlist.application',
                                    'livewire' => 'application',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'devicetokenlist.device_token',
                                    'name' => 'devicetokenlist.device_token',
                                    'livewire' => 'device_token',
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

                            @error('device_info')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('device_type')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('application')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('device_token')
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



@permission('edit-devicetokenlist')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-devicetokenlist-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-devicetokenlist-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-devicetokenlist-modal-label">{{ $devicetokenlist->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="devicetokenlist_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'devicetokenlist.slug',
                                    'name' => 'devicetokenlist.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'devicetokenlist.user',
                                    'name' => 'devicetokenlist.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $devicetokenlist->user_id,
                                    // 'is_select' => false,
                                    // 'value' => $devicetokenlist->user->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'devicetokenlist.device_info',
                                    'name' => 'devicetokenlist.device_info',
                                    'val' => $devicetokenlist->device_info,
                                    'livewire' => 'device_info',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'devicetokenlist.device_type',
                                    'name' => 'devicetokenlist.device_type',
                                    'val' => $devicetokenlist->device_type,
                                    'livewire' => 'device_type',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'devicetokenlist.application',
                                    'name' => 'devicetokenlist.application',
                                    'val' => $devicetokenlist->application,
                                    'livewire' => 'application',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'devicetokenlist.device_token',
                                    'name' => 'devicetokenlist.device_token',
                                    'val' => $devicetokenlist->device_token,
                                    'livewire' => 'device_token',
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

                            @error('device_info')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('device_type')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('application')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('device_token')
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
