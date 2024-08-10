<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}">
    <div class='form-group'>
        <label for='{{ $name }}' class="block font-medium text-sm text-gray-700">
            {{ $required ?? false ? '***' : '' }} {{ __($label ?? '') }}
        </label>
        <input {{ $required ?? null }} name='{{ $name }}' id='{{ $name }}' type='{{ $type ?? 'text' }}'
            {{-- value='{{ old($name) }}' --}}
            class='form-control rounded-md shadow-sm border-gray-300 @error('{{ $name }}') is-invalid @enderror'
            placeholder='{{ __('global.enter') }} {{ __($placeholder ?? '') }}'
            {{ ($type ?? 'text') == 'number' ? 'step=' . ($step ?? 1) : '' }}
            {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }} {{ $extra ?? '' }}>
        @error('{{ $name }}')
            <span class='invalid-feedback' role='alert'>
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
