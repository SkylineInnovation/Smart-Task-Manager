@permission('index-devicetokenlist')
    <li>
        <a class='slide-item' href='{{ route('devicetokenlist.index') }}'>
            <span>{{ __('global.devicetokenlists') }}</span>
        </a>
    </li>
@endpermission


@permission('index-otpsendcode')
    <li>
        <a class='slide-item' href='{{ route('otpsendcode.index') }}'>
            <span>{{ __('global.otpsendcodes') }}</span>
        </a>
    </li>
@endpermission


@permission('index-passwordcode')
    <li>
        <a class='slide-item' href='{{ route('passwordcode.index') }}'>
            <span>{{ __('global.passwordcodes') }}</span>
        </a>
    </li>
@endpermission
