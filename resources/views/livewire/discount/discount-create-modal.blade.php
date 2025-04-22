@permission('create-discount')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-discount-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-discount-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-discount-modal-label">
                        {{ __('global.create-discount') }}
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
                                    'label' => 'discount.slug',
                                    'name' => 'discount.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'discount.task',
                                    'name' => 'discount.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'discount.user',
                                    'name' => 'discount.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                <div class="col-6">
                                    <div wire:ignore class="form-group">
                                        <label for="users">{{ __('area.manager') }}</label>
                                        <select id="users" multiple class="">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (in_array($user->id, $selectedUsers)) selected @endif>
                                                    {{ $user->first_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selectedUsers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @include('inputs.create.input', [
                                    'label' => 'discount.amount',
                                    'name' => 'discount.amount',
                                    'livewire' => 'amount',
                                    'type' => 'number', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'discount.reason',
                                    'name' => 'discount.reason',
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
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



@permission('edit-discount')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-discount-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-discount-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-discount-modal-label">{{ $discount->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="discount_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'discount.slug',
                                    'name' => 'discount.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'discount.task',
                                    'name' => 'discount.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $discount->task_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'discount.user',
                                    'name' => 'discount.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $discount->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'discount.amount',
                                    'name' => 'discount.amount',
                                    'val' => $discount->amount,
                                    'livewire' => 'amount',
                                    'type' => 'number', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'discount.reason',
                                    'name' => 'discount.reason',
                                    'val' => $discount->reason,
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
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

    <script>
        // document.addEventListener('livewire:load', () => {
        //     const select = new TomSelect("#users", {
        //         plugins: ['remove_button'],
        //         onChange: function(values) {
        //             @this.set('selectedUsers', values);
        //         },
        //         placeholder: "Select employees...",
        //     });

        //     // Sync TomSelect with Livewire on manual update
        //     Livewire.hook('message.processed', () => {
        //         select.setValue(@this.get('selectedUsers') ?? []);
        //     });
        // });


        document.addEventListener('livewire:load', function() {
            let selectInstance = new TomSelect('#users', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedUsers', values);
                },
                maxItems: 200, // Limit the number of selected items
                items: {!! json_encode($selectedUsers) !!}, // Preselect existing values
                placeholder: "{{ __('global.select-employees') }}",
                allowEmptyOption: true,
                dropdownConveyor: true,
                render: {
                    item: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    },
                    option: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    }
                }
            });

            // Sync back to Livewire on change
            document.getElementById('users').addEventListener('change', function(e) {
                @this.set('selectedUsers', [...this.selectedOptions].map(o => o.value));
            });
        });
    </script>
@endpermission
