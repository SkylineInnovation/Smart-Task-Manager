@permission('create-area')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-area-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-area-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-area-modal-label">
                        {{ __('global.create-area') }}
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
                                    'label' => 'area.slug',
                                    'name' => 'area.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'area.name',
                                    'name' => 'area.name',
                                    'livewire' => 'name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'area.location',
                                    'name' => 'area.location',
                                    'livewire' => 'location',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'area.manager',
                                    'name' => 'area.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                {{--  --}}
                                <div wire:ignore class="form-group">
                                    <label for="user-select">{{ __('Assign Manager') }}</label>
                                    <select id="user-select" multiple class="">
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
                                {{--  --}}

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
            let selectInstance = new TomSelect('#user-select', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedManagerD', values);
                },
                maxItems: 200, // Limit the number of selected items
                items: {!! json_encode($selectedManagerD) !!}, // Preselect existing values
                placeholder: "{{ __('global.select-manager') }}",
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
            document.getElementById('user-select').addEventListener('change', function(e) {
                @this.set('selectedManagerD', [...this.selectedOptions].map(o => o.value));
            });
        });
    </script>
@endpermission



@permission('edit-area')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-area-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-area-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-area-modal-label">{{ $area->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="area_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'area.slug',
                                    'name' => 'area.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.input', [
                                    'label' => 'area.name',
                                    'name' => 'area.name',
                                    'val' => $area->name,
                                    'livewire' => 'name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'area.location',
                                    'name' => 'area.location',
                                    'val' => $area->location,
                                    'livewire' => 'location',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'area.manager',
                                    'name' => 'area.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    'val' => $area->manager_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
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
@endpermission
