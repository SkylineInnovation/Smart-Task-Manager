<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="form-group">
        <label for="{{ $livewire }}" class="block font-medium text-sm text-gray-700">
            {{ __($label ?? 'apptext.the_text') }}
        </label>
        <textarea name="{{ $livewire }}" id="{{ $livewire }}" rows="{{ $rows ?? 3 }}"
            @if (!($active ?? true)) disabled readonly @endif class="form-control rounded-md shadow-sm border-gray-300"
            placeholder="{{ __('global.enter') }} {{ __($label ?? 'apptext.the_text') }}" wire:model="{{ $livewire }}"
            @guest disabled readonly @endguest></textarea>
    </div>
</div>
