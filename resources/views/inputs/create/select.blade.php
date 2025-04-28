<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}" dir="ltr">
    <div class='form-group text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}'>
        <label for='{{ $name }}'>{{ $required ?? false ? '***' : '' }}
            {{ __($label) }} </label>
        @if ($is_select ?? true)
            <select {{ $required ?? null }} name='{{ $name }}' id='{{ $name }}'
                class='form-control rounded-md shadow-sm border-gray-300 @error('{{ $name }}') is-invalid @enderror'
                {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }}>
                <option selected>{{ __('global.select') }} {{ __($label) }}</option>
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
        @else
            {{--  --}}{{--  --}}{{--  --}}
            {{--  --}}{{--  --}}{{--  --}}
            @php
                $name_no_dot = str_replace('.', '', $name);
            @endphp
            <div class="input-group">
                <input id="{{ $name_no_dot }}-search" name="{{ $name_no_dot }}-search" class="form-control"
                    type="text" placeholder="{{ __($label) }}" autocomplete="off"
                    list="{{ $name_no_dot }}_the_arr" onfocus="this.value=''"
                    onchange="on{{ $name_no_dot }}ChangeSearch(event)">
                <datalist id="{{ $name_no_dot }}_the_arr">
                    <option data-value="0" value="All"></option>
                    @foreach ($arr as $obj)
                        <option data-value="{{ $obj->id }}" value="{{ $obj->crud_name() ?? $obj->id }}">
                        </option>
                    @endforeach
                </datalist>
            </div>

            <input type="hidden" name="{{ $name_no_dot }}-hidden" id="{{ $name_no_dot }}-hidden" value="1"
                {{ ($livewire ?? null) == null ? null : 'wire:model=' . $livewire }}>

            <script>
                function on{{ $name_no_dot }}ChangeSearch(e) {
                    let value = e.target.value

                    let selected = document.body.querySelector("#{{ $name_no_dot }}_the_arr option[value=\"" + value + "\"]")
                    console.log(selected);

                    if (selected) {
                        let id = selected.dataset.value
                        console.log(selected.dataset);
                        console.log(id);

                        document.getElementById("{{ $name_no_dot }}-hidden").value = id;
                        @this.set('{{ $livewire }}', id);

                        document.getElementById("{{ $name_no_dot }}-search").blur();
                    }
                }
            </script>
            {{--  --}}{{--  --}}{{--  --}}
            {{--  --}}{{--  --}}{{--  --}}
        @endif
    </div>
</div>
