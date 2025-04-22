@permission('create-exchangepermission')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-exchangepermission-modal" data-backdrop="static"
        data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-new-exchangepermission-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-exchangepermission-modal-label">
                        {{ __('global.create-exchangepermission') }}
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
                                    'label' => 'exchangepermission.slug',
                                    'name' => 'exchangepermission.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'exchangepermission.user',
                                    'name' => 'exchangepermission.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                <div class="col-6">
                                    <div wire:ignore class="form-group">
                                        <label for="users">{{ __('discount.user') }}</label>
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
                                    'label' => 'exchangepermission.content',
                                    'name' => 'exchangepermission.content',
                                    'livewire' => 'content',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 9,
                                    'md' => 9,
                                    'sm' => 9,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'exchangepermission.amount',
                                    'name' => 'exchangepermission.amount',
                                    'livewire' => 'amount',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 3,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'exchangepermission.attachment',
                                    'name' => 'exchangepermission.attachment',
                                    'livewire' => 'attachment',
                                    'type' => 'file', // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.request_date',
                                    'name' => 'exchangepermission.request_date',
                                    'livewire' => 'request_date',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.select', [
                                    'label' => 'exchangepermission.financial_director',
                                    'name' => 'exchangepermission.financial_director_id',
                                    'arr' => $financial_directors,
                                    'livewire' => 'financial_director_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.financial_director_response',
                                    'name' => 'exchangepermission.financial_director_response',
                                    'livewire' => 'financial_director_response',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.financial_director_time',
                                    'name' => 'exchangepermission.financial_director_time',
                                    'livewire' => 'financial_director_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.select', [
                                    'label' => 'exchangepermission.technical_director',
                                    'name' => 'exchangepermission.technical_director_id',
                                    'arr' => $technical_directors,
                                    'livewire' => 'technical_director_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.technical_director_response',
                                    'name' => 'exchangepermission.technical_director_response',
                                    'livewire' => 'technical_director_response',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.technical_director_time',
                                    'name' => 'exchangepermission.technical_director_time',
                                    'livewire' => 'technical_director_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'exchangepermission.status',
                                    'name' => 'exchangepermission.status',
                                    'livewire' => 'status',
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

    <script>
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



@permission('edit-exchangepermission')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade"
        id="update-exchangepermission-modal" tabindex="-1" role="dialog"
        aria-labelledby="update-exchangepermission-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-exchangepermission-modal-label">
                        {{ $exchangepermission->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="exchangepermission_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.slug',
                                    'name' => 'exchangepermission.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'exchangepermission.user',
                                    'name' => 'exchangepermission.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $exchangepermission->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.content',
                                    'name' => 'exchangepermission.content',
                                    'val' => $exchangepermission->content,
                                    'livewire' => 'content',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 9,
                                    'md' => 9,
                                    'sm' => 9,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.amount',
                                    'name' => 'exchangepermission.amount',
                                    'val' => $exchangepermission->amount,
                                    'livewire' => 'amount',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 3,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.attachment',
                                    'name' => 'exchangepermission.attachment',
                                    'val' => $exchangepermission->attachment,
                                    'livewire' => 'attachment',
                                    'type' => 'file', // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.request_date',
                                    'name' => 'exchangepermission.request_date',
                                    'val' => $exchangepermission->request_date,
                                    'livewire' => 'request_date',
                                    'type' => 'date', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'exchangepermission.financial_director',
                                    'name' => 'exchangepermission.financial_director_id',
                                    'arr' => $financial_directors,
                                    'livewire' => 'financial_director_id',
                                    'val' => $exchangepermission->financial_director_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.financial_director_response',
                                    'name' => 'exchangepermission.financial_director_response',
                                    'val' => $exchangepermission->financial_director_response,
                                    'livewire' => 'financial_director_response',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.financial_director_time',
                                    'name' => 'exchangepermission.financial_director_time',
                                    'val' => $exchangepermission->financial_director_time,
                                    'livewire' => 'financial_director_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'exchangepermission.technical_director',
                                    'name' => 'exchangepermission.technical_director_id',
                                    'arr' => $technical_directors,
                                    'livewire' => 'technical_director_id',
                                    'val' => $exchangepermission->technical_director_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.technical_director_response',
                                    'name' => 'exchangepermission.technical_director_response',
                                    'val' => $exchangepermission->technical_director_response,
                                    'livewire' => 'technical_director_response',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.technical_director_time',
                                    'name' => 'exchangepermission.technical_director_time',
                                    'val' => $exchangepermission->technical_director_time,
                                    'livewire' => 'technical_director_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'exchangepermission.status',
                                    'name' => 'exchangepermission.status',
                                    'val' => $exchangepermission->status,
                                    'livewire' => 'status',
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
