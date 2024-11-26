<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}">
    <div class='form-group text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}'>
        <label for='{{ $name }}'>{{ $required ?? false ? '***' : '' }} {{ __($label) }} </label>
        <select {{ $required ?? null }} name='{{ $name }}' id='{{ $name }}'
            class='form-control rounded-md shadow-sm border-gray-300 @error('{{ $name }}') is-invalid @enderror'
            {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }}>

            <option value='' selected>{{ __('global.select') }} {{ __($label) }}</option>
            @foreach ($arr as $obj)
                <option value='{{ $obj->id }}' @if ($obj->id == $val) selected @endif>
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
