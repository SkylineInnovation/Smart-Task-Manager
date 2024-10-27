<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" wire:model="branch_id">
            @csrf

            <div class="row">

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

            </div>

            @role('owner')
                <div>
                    <p>{{ __('global.managers') }}</p>
                    <div class="row">
                        @foreach ($managers as $manager)
                            <div class="col-4">
                                <div class="form-check form-check-inline">
                                    <input wire:model='selectedManagers' class="form-check-input" type="checkbox"
                                        value="{{ $manager->id }}" id="selected-manager-{{ $manager->id }}">
                                    <label class="form-check-label" for="selected-manager-{{ $manager->id }}">
                                        {{ $manager->name() }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endrole

        </div>


        <div class="form-group">

            @foreach ($errors->all() as $error)
                <span class='alert alert-danger btn'>{{ $error }}</span>
            @endforeach

        </div>

        <div class="modal-footer">

            <button type="button" wire:click.prevent="update()" class="btn btn-success">
                {{ __('global.save-changes') }}
            </button>
        </div>
    </form>
</div>
