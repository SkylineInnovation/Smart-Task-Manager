@permission('restore-devicetokenlist')
    <li>
        <a class='slide-item' href='{{ route('devicetokenlist.index.trash') }}'>
            <span>{{ __('global.devicetokenlists') }}</span>
        </a>
    </li>
@endpermission


@permission('restore-otpsendcode')
    <li>
        <a class='slide-item' href='{{ route('otpsendcode.index.trash') }}'>
            <span>{{ __('global.otpsendcodes') }}</span>
        </a>
    </li>
@endpermission


@permission('restore-passwordcode')
    <li>
        <a class='slide-item' href='{{ route('passwordcode.index.trash') }}'>
            <span>{{ __('global.passwordcodes') }}</span>
        </a>
    </li>
@endpermission
