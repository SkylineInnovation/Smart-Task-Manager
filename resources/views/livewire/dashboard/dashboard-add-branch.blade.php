<div class="col-md-3 col-6 mb-4 d-flex text-center justify-content-center">
    <a wire:click="get_create_date()" href="#" data-toggle="modal" data-target="#create-new-branch-modal"
        class="mouseHover col-md-12 py-3 px-1">
        <div class="col-md-12 d-flex justify-content-center pb-3">
            <img src="{{ asset('assets/dashboard/add.png') }}" width="32px" height="32px">
        </div>
        <div class="col-md-12 px-0 d-flex justify-content-center text-dark">{{ __('global.add-branch') }}</div>
    </a>

    @permission('create-branch')
        <!-- Modal -->
        <div wire:ignore.self class="modal fade text-start" id="create-new-branch-modal" data-backdrop="static"
            data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-new-branch-modal-label"
            aria-hidden="true">
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

                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">
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
                                {{--  --}}
                                <div wire:ignore class="form-group col-6">
                                    <label for="managers_id">{{ __('branch.manager') }}</label>
                                    <select id="managers_id" multiple class="">
                                        @foreach ($managers as $man)
                                            <option value="{{ $man->id }}"
                                                @if (in_array($man->id, $selectedManager)) selected @endif>
                                                {{ $man->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedManager')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}

                                {{-- @include('inputs.create.select', [
                                    'label' => 'branch.responsible',
                                    'name' => 'branch.responsible_id',
                                    'arr' => $responsibles,
                                    'livewire' => 'responsible_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div wire:ignore class="form-group col-6">
                                    <label for="res_id">{{ __('branch.responsible') }}</label>
                                    <select id="res_id" multiple class="">
                                        @foreach ($responsibles as $res)
                                            <option value="{{ $res->id }}"
                                                @if (in_array($res->id, $selectedResponsible)) selected @endif>
                                                {{ $res->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedResponsible')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

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


                </div>
            </div>
        </div>

        <script>
            document.addEventListener('livewire:load', function() {
                let selectInstance = new TomSelect('#managers_id', {
                    plugins: ['remove_button', 'dropdown_input'],
                    persist: false,
                    create: false,
                    closeAfterSelect: true,
                    onChange: function(values) {
                        @this.set('selectedManager', values);
                    },
                    maxItems: 1, // Limit the number of selected items
                    items: {!! json_encode($selectedManager) !!}, // Preselect existing values
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
                    @this.set('selectedManager', [...this.selectedOptions].map(o => o.value));
                });
            });
            document.addEventListener('livewire:load', function() {
                let selectInstance = new TomSelect('#res_id', {
                    plugins: ['remove_button', 'dropdown_input'],
                    persist: false,
                    create: false,
                    closeAfterSelect: true,
                    onChange: function(values) {
                        @this.set('selectedResponsible', values);
                    },
                    maxItems: 1, // Limit the number of selected items
                    items: {!! json_encode($selectedResponsible) !!}, // Preselect existing values
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

                // Sync back to Livewire on change
                document.getElementById('res_id').addEventListener('change', function(e) {
                    @this.set('selectedResponsible', [...this.selectedOptions].map(o => o.value));
                });
            });
        </script>
    @endpermission
</div>
