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

@permission('index-task')
    <li>
        <a class='slide-item' href='{{ route('task.index') }}'>
            <span>{{ __('global.tasks') }}</span>
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
