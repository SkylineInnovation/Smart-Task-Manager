@permission('create-branch')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-branch-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-branch-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-branch-modal-label">
                        {{ __('global.create-branch') }}
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
                                    'label' => 'branch.slug',
                                    'name' => 'branch.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'branch.name',
                                    'name' => 'branch.name',
                                    'livewire' => 'name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.location',
                                    'name' => 'branch.location',
                                    'livewire' => 'location',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.phone',
                                    'name' => 'branch.phone',
                                    'livewire' => 'phone',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.number',
                                    'name' => 'branch.number',
                                    'livewire' => 'number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.fax',
                                    'name' => 'branch.fax',
                                    'livewire' => 'fax',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.email',
                                    'name' => 'branch.email',
                                    'livewire' => 'email',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.password',
                                    'name' => 'branch.password',
                                    'livewire' => 'password',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.website',
                                    'name' => 'branch.website',
                                    'livewire' => 'website',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'branch.commercial_register',
                                    'name' => 'branch.commercial_register',
                                    'livewire' => 'commercial_register',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'branch.area',
                                    'name' => 'branch.area_id',
                                    'arr' => $areas,
                                    'livewire' => 'area_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'branch.manager',
                                    'name' => 'branch.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div wire:ignore class="form-group col-6">
                                    <label for="manager_id">{{ __('branch.manager') }}</label>
                                    <select id="manager_id" multiple class="">
                                        @foreach ($managers as $man)
                                            <option value="{{ $man->id }}"
                                                @if (in_array($man->id, $selectedManagerD)) selected @endif>
                                                {{ $man->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedManagerD')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div wire:ignore class="form-group col-6">
                                    <label for="res_id">{{ __('branch.res') }}</label>
                                    <select id="res_id" multiple class="">
                                        @foreach ($responsibles as $res)
                                            <option value="{{ $res->id }}"
                                                @if (in_array($res->id, $selectedRes)) selected @endif>
                                                {{ $res->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedRes')
                                        <span class="text-danger">{{ $message2 }}</span>
                                    @enderror
                                </div>

                                {{-- @include('inputs.create.select', [
                                    'label' => 'branch.responsible',
                                    'name' => 'branch.responsible_id',
                                    'arr' => $responsibles,
                                    'livewire' => 'responsible_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
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
            let selectInstance1 = new TomSelect('#manager_id', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedRes', values);
                },
                maxItems: 200, // Limit the number of selected items
                items: {!! json_encode($selectedRes) !!}, // Preselect existing values
                placeholder: "{{ __('branch.responsible') }}",
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
            let selectInstance2 = new TomSelect('#res_id', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedManagerD', values);
                },
                maxItems: 200, // Limit the number of selected items
                items: {!! json_encode($selectedManagerD) !!}, // Preselect existing values
                placeholder: "{{ __('branch.manager') }}",
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
            document.getElementById('manager_id').addEventListener('change', function(e) {
                @this.set('selectedManagerD', [...this.selectedOptions].map(o => o.value));
            });
        });
    </script>
@endpermission



@permission('edit-branch')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-branch-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-branch-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-branch-modal-label">{{ $branch->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="branch_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'branch.slug',
                                    'name' => 'branch.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.input', [
                                    'label' => 'branch.name',
                                    'name' => 'branch.name',
                                    'val' => $branch->name,
                                    'livewire' => 'name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.location',
                                    'name' => 'branch.location',
                                    'val' => $branch->location,
                                    'livewire' => 'location',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.phone',
                                    'name' => 'branch.phone',
                                    'val' => $branch->phone,
                                    'livewire' => 'phone',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.number',
                                    'name' => 'branch.number',
                                    'val' => $branch->number,
                                    'livewire' => 'number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.fax',
                                    'name' => 'branch.fax',
                                    'val' => $branch->fax,
                                    'livewire' => 'fax',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.email',
                                    'name' => 'branch.email',
                                    'val' => $branch->email,
                                    'livewire' => 'email',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.password',
                                    'name' => 'branch.password',
                                    'val' => $branch->password,
                                    'livewire' => 'password',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.website',
                                    'name' => 'branch.website',
                                    'val' => $branch->website,
                                    'livewire' => 'website',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'branch.commercial_register',
                                    'name' => 'branch.commercial_register',
                                    'val' => $branch->commercial_register,
                                    'livewire' => 'commercial_register',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'branch.area',
                                    'name' => 'branch.area_id',
                                    'arr' => $areas,
                                    'livewire' => 'area_id',
                                    'val' => $branch->area_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'branch.manager',
                                    'name' => 'branch.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    'val' => $branch->manager_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'branch.responsible',
                                    'name' => 'branch.responsible_id',
                                    'arr' => $responsibles,
                                    'livewire' => 'responsible_id',
                                    'val' => $branch->responsible_id,
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
