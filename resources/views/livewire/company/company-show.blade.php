<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        @include('inputs.edit.input', [
            'label' => 'company.name',
            'name' => 'company.name',
            'val' => $company->name,
            'livewire' => 'name',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.address',
            'name' => 'company.address',
            'val' => $company->address,
            'livewire' => 'address',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.email',
            'name' => 'company.email',
            'val' => $company->email,
            'livewire' => 'email',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.phone',
            'name' => 'company.phone',
            'val' => $company->phone,
            'livewire' => 'phone',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.number',
            'name' => 'company.number',
            'val' => $company->number,
            'livewire' => 'number',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.fax',
            'name' => 'company.fax',
            'val' => $company->fax,
            'livewire' => 'fax',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            'lg' => 4,
            'md' => 4,
            'sm' => 12,
        ])

        @include('inputs.edit.input', [
            'label' => 'company.website',
            'name' => 'company.website',
            'val' => $company->website,
            'livewire' => 'website',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            // 'lg' => 6, 'md' => 6, 'sm' => 12,
        ])
        @include('inputs.edit.input', [
            'label' => 'company.commercial_register',
            'name' => 'company.commercial_register',
            'val' => $company->commercial_register,
            'livewire' => 'commercial_register',
            'type' => 'text', // 'step' => 1,
            // 'required' => 'required',
            // 'lg' => 6, 'md' => 6, 'sm' => 12,
        ])

        @include('inputs.edit.select', [
            'label' => 'company.technical_director',
            'name' => 'company.technical_director_id',
            'arr' => $technical_directors,
            'livewire' => 'technical_director_id',
            'val' => $company->technical_director_id,
            // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
            // 'lg' => 6, 'md' => 6, 'sm' => 12,
        ])

        @include('inputs.edit.select', [
            'label' => 'company.financial_director',
            'name' => 'company.financial_director_id',
            'arr' => $financial_directors,
            'livewire' => 'financial_director_id',
            'val' => $company->financial_director_id,
            // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
            // 'lg' => 6, 'md' => 6, 'sm' => 12,
        ])

        @include('inputs.edit.input', [
            'label' => 'company.logo',
            'name' => 'company.logo',
            'val' => $company->logo,
            'livewire' => 'logo',
            'type' => 'file', // 'required' => 'required',
            'lg' => 12,
            'md' => 12,
            'sm' => 12,
        ])

    </div>

    <div class="form-group">

        @foreach ($errors->all() as $error)
            <span class='alert alert-danger btn'>{{ $error }}</span>
        @endforeach

    </div>

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    <div class="modal-footer">
        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn"
            data-dismiss="modal">{{ __('global.close') }}</button>
        <button type="button" wire:click.prevent="update()" class="btn btn-success">
            {{ __('global.save-changes') }}
        </button>
    </div>
</div>
