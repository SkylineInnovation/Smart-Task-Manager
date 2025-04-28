@permission('create-userdetail')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-userdetail-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-userdetail-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-userdetail-modal-label">
                        {{ __('global.create-userdetail') }}
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
                                @include('inputs.create.select', [
                                    'label' => 'userdetail.user',
                                    'name' => 'userdetail.user_id',
                                    'arr' => $users,
                                    'is_select' => false,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.title',
                                    'name' => 'userdetail.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.nationality',
                                    'name' => 'userdetail.nationality',
                                    'livewire' => 'nationality',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.id_number',
                                    'name' => 'userdetail.id_number',
                                    'livewire' => 'id_number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.address',
                                    'name' => 'userdetail.address',
                                    'livewire' => 'address',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.qualification',
                                    'name' => 'userdetail.qualification',
                                    'livewire' => 'qualification',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.salary',
                                    'name' => 'userdetail.salary',
                                    'livewire' => 'salary',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.home',
                                    'name' => 'userdetail.home',
                                    'livewire' => 'home',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.transport',
                                    'name' => 'userdetail.transport',
                                    'livewire' => 'transport',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'userdetail.branch',
                                    'name' => 'userdetail.branch_id',
                                    'is_select' => false,
                                    'arr' => $branches,
                                    'livewire' => 'branch_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
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



@permission('edit-userdetail')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-userdetail-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-userdetail-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-userdetail-modal-label">{{ $userdetail->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="userdetail_id">
                            @csrf

                            <div class="row">
                                @include('inputs.edit.select', [
                                    'label' => 'userdetail.user',
                                    'name' => 'userdetail.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $userdetail->user_id,
                                    'is_select' => false,
                                    'value' => $userdetail->user->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.title',
                                    'name' => 'userdetail.title',
                                    'val' => $userdetail->title,
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.nationality',
                                    'name' => 'userdetail.nationality',
                                    'val' => $userdetail->nationality,
                                    'livewire' => 'nationality',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.id_number',
                                    'name' => 'userdetail.id_number',
                                    'val' => $userdetail->id_number,
                                    'livewire' => 'id_number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.address',
                                    'name' => 'userdetail.address',
                                    'val' => $userdetail->address,
                                    'livewire' => 'address',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.qualification',
                                    'name' => 'userdetail.qualification',
                                    'val' => $userdetail->qualification,
                                    'livewire' => 'qualification',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.salary',
                                    'name' => 'userdetail.salary',
                                    'val' => $userdetail->salary,
                                    'livewire' => 'salary',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.home',
                                    'name' => 'userdetail.home',
                                    'val' => $userdetail->home,
                                    'livewire' => 'home',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'userdetail.transport',
                                    'name' => 'userdetail.transport',
                                    'val' => $userdetail->transport,
                                    'livewire' => 'transport',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'userdetail.branch',
                                    'name' => 'userdetail.branch_id',
                                    'arr' => $branches,
                                    'livewire' => 'branch_id',
                                    'val' => $userdetail->branch_id,
                                    'is_select' => false,
                                    'value' => $userdetail->branch->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
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
