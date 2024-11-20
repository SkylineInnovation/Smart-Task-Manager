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

@permission('restore-dailytask')
    <li>
        <a class='slide-item' href='{{ route('dailytask.index.trash') }}'>
            <span>{{ __('global.dailytasks') }}</span>
        </a>
    </li>
@endpermission


@permission('restore-loghistory')
    <li>
        <a class='slide-item' href='{{ route('loghistory.index.trash') }}'>
            <span>{{ __('global.loghistories') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-department')
    <li>
        <a class='slide-item' href='{{ route('department.index.trash') }}'>
            <span>{{ __('global.departments') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-branch')
    <li>
        <a class='slide-item' href='{{ route('branch.index.trash') }}'>
            <span>{{ __('global.branches') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-company')
    <li>
        <a class='slide-item' href='{{ route('company.index.trash') }}'>
            <span>{{ __('global.companies') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-area')
    <li>
        <a class='slide-item' href='{{ route('area.index.trash') }}'>
            <span>{{ __('global.areas') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-userdetail')
    <li>
        <a class='slide-item' href='{{ route('userdetail.index.trash') }}'>
            <span>{{ __('global.userdetails') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-work')
    <li>
        <a class='slide-item' href='{{ route('work.index.trash') }}'>
            <span>{{ __('global.works') }}</span>
        </a>
    </li>
@endpermission

@permission('restore-exchangepermission')
    <li>
        <a class='slide-item' href='{{ route('exchangepermission.index.trash') }}'>
            <span>{{ __('global.exchangepermissions') }}</span>
        </a>
    </li>
@endpermission
