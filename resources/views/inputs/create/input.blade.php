<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}">
    <div class='form-group'>
        <label for='{{ $name }}' class="block font-medium text-sm text-gray-700">
            {{ $required ?? false ? '***' : '' }} {{ __($label ?? '') }}
        </label>
        <input {{ $required ?? null }} name='{{ $name }}' id='{{ $name }}' type='{{ $type ?? 'text' }}'
            class='form-control rounded-md shadow-sm border-gray-300' min="{{ $min ?? '' }}" max="{{ $max ?? '' }}"
            placeholder='{{ __('global.enter') }} {{ __($placeholder ?? '') }}'
            {{ ($type ?? 'text') == 'number' ? 'step=' . ($step ?? 1) : '' }}
            {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }} {{ $extra ?? '' }}
            @guest disabled readonly @endguest>
    </div>
</div>
