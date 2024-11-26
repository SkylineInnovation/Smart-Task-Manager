<div class="col-lg-{{ $lg ?? 6 }} col-md-{{ $md ?? 6 }} col-sm-{{ $sm ?? 12 }}">
    <div class='form-group text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}'>
        @if ($a ?? null)
            <a href="{{ $a }}" target="_blank">
                <label>{{ __($label) }}</label>
                <input disabled readonly value='{{ $val }}' class='form-control' type="{{ $type ?? 'text' }}">
            </a>
        @else
            <label>{{ __($label) }}</label>
            <input disabled readonly value='{{ $val }}' class='form-control' type="{{ $type ?? 'text' }}">
        @endif
    </div>
</div>
