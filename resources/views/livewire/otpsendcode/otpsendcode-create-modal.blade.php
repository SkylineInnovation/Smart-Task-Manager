@permission('create-otpsendcode')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-otpsendcode-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-otpsendcode-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-otpsendcode-modal-label">
                        {{ __('global.create-otpsendcode') }}
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
                                    'label' => 'otpsendcode.slug',
                                    'name' => 'otpsendcode.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'otpsendcode.user',
                                    'name' => 'otpsendcode.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'otpsendcode.otp_code',
                                    'name' => 'otpsendcode.otp_code',
                                    'livewire' => 'otp_code',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'otpsendcode.phone_number',
                                    'name' => 'otpsendcode.phone_number',
                                    'livewire' => 'phone_number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'otpsendcode.applecation',
                                    'name' => 'otpsendcode.applecation',
                                    'livewire' => 'applecation',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'otpsendcode.code_status',
                                    'name' => 'otpsendcode.code_status',
                                    'livewire' => 'code_status',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'otpsendcode.back_response',
                                    'name' => 'otpsendcode.back_response',
                                    'livewire' => 'back_response',
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

                            @error('otp_code')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('phone_number')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('applecation')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('code_status')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('back_response')
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



@permission('edit-otpsendcode')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-otpsendcode-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-otpsendcode-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-otpsendcode-modal-label">{{ $otpsendcode->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="otpsendcode_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.slug',
                                    'name' => 'otpsendcode.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'otpsendcode.user',
                                    'name' => 'otpsendcode.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $otpsendcode->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.otp_code',
                                    'name' => 'otpsendcode.otp_code',
                                    'val' => $otpsendcode->otp_code,
                                    'livewire' => 'otp_code',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.phone_number',
                                    'name' => 'otpsendcode.phone_number',
                                    'val' => $otpsendcode->phone_number,
                                    'livewire' => 'phone_number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.applecation',
                                    'name' => 'otpsendcode.applecation',
                                    'val' => $otpsendcode->applecation,
                                    'livewire' => 'applecation',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.code_status',
                                    'name' => 'otpsendcode.code_status',
                                    'val' => $otpsendcode->code_status,
                                    'livewire' => 'code_status',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'otpsendcode.back_response',
                                    'name' => 'otpsendcode.back_response',
                                    'val' => $otpsendcode->back_response,
                                    'livewire' => 'back_response',
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

                            @error('otp_code')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('phone_number')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('applecation')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('code_status')
                                <span class='alert alert-danger btn'>{{ $message }}</span>
                            @enderror

                            @error('back_response')
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
