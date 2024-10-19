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

@permission('index-attachment')
    <li>
        <a class='slide-item' href='{{ route('attachment.index') }}'>
            <span>{{ __('global.attachments') }}</span>
        </a>
    </li>
@endpermission

@permission('index-comment')
    <li>
        <a class='slide-item' href='{{ route('comment.index') }}'>
            <span>{{ __('global.comments') }}</span>
        </a>
    </li>
@endpermission

@permission('index-extratime')
    <li>
        <a class='slide-item' href='{{ route('extratime.index') }}'>
            <span>{{ __('global.extratimes') }}</span>
        </a>
    </li>
@endpermission

@permission('index-leave')
    <li>
        <a class='slide-item' href='{{ route('leave.index') }}'>
            <span>{{ __('global.leaves') }}</span>
        </a>
    </li>
@endpermission

@permission('index-discount')
    <li>
        <a class='slide-item' href='{{ route('discount.index') }}'>
            <span>{{ __('global.discounts') }}</span>
        </a>
    </li>
@endpermission

@permission('index-loghistory')
    <li>
        <a class='slide-item' href='{{ route('loghistory.index') }}'>
            <span>{{ __('global.loghistories') }}</span>
        </a>
    </li>
@endpermission

@permission('index-department')
    <li>
        <a class='slide-item' href='{{ route('department.index') }}'>
            <span>{{ __('global.departments') }}</span>
        </a>
    </li>
@endpermission
