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

@permission('restore-task')
    <li>
        <a class='slide-item' href='{{ route('task.index.trash') }}'>
            <span>{{ __('global.tasks') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-attachment')
    <li>
        <a class='slide-item' href='{{ route('attachment.index.trash') }}'>
            <span>{{ __('global.attachments') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-comment')
    <li>
        <a class='slide-item' href='{{ route('comment.index.trash') }}'>
            <span>{{ __('global.comments') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-extratime')
    <li>
        <a class='slide-item' href='{{ route('extratime.index.trash') }}'>
            <span>{{ __('global.extratimes') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-leave')
    <li>
        <a class='slide-item' href='{{ route('leave.index.trash') }}'>
            <span>{{ __('global.leaves') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-discount')
    <li>
        <a class='slide-item' href='{{ route('discount.index.trash') }}'>
            <span>{{ __('global.discounts') }}</span>
        </a>
    </li>
@endpermission
