<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}" dir="ltr">
    <div class='form-group'>
        <label for='{{ $name }}'
            class="text-{{ App::getLocale() == 'en' ? 'sart' : 'end' }}">{{ $required ?? false ? '***' : '' }}
            {{ __($label) }} </label>
        <select {{ $required ?? null }} name='{{ $name }}' id='{{ $name }}'
            class='form-control rounded-md shadow-sm border-gray-300 @error('{{ $name }}') is-invalid @enderror'
            {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }}>
            <option value='' selected>{{ __('global.select') }} {{ __($label) }}</option>
            @foreach ($arr as $obj)
                <option value='{{ $obj->id }}' @if ($obj->id == old($name)) selected @endif>
                    <?php try { ?>
                    {{ $obj->crud_name() }}
                    <?php } catch (\Exception $e) { ?>
                    {{ $obj->name }}
                    <?php } ?>
                </option>
            @endforeach
        </select>
    </div>
</div>
