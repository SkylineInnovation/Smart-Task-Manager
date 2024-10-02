<table>
    <thead>
        <tr>
            <td>#</td>
            {{-- <td>id</td> --}}
            {{-- <td>slug</td> --}}


            <td>{{ __('dailytask.manager') }}</td>
            <td>{{ __('dailytask.title') }}</td>

            <td>{{ __('dailytask.description') }}</td>

            <td>{{ __('dailytask.start_time') }}</td>

            <td>{{ __('dailytask.end_time') }}</td>

            <td>{{ __('dailytask.proearty') }}</td>

            {{-- <td>{{ __('dailytask.status') }}</td> --}}

            <td>{{ __('dailytask.repeat_time') }}</td>

            <td>{{ __('dailytask.repeat_evrey') }}</td>


            <td>{{ __('dailytask.created_at') }}</td>
            {{-- <td>updated at</td> --}}
            {{-- <td>deleted at</td> --}}

        </tr>
    </thead>

    <tbody>
        @foreach ($dailytasks as $dailytask)
            <tr>
                <td>{{ ++$number }}</td>
                {{-- <td>{{ $dailytask->id }}</td> --}}
                {{-- <td>{{ $dailytask->slug }}</td> --}}


                <td>{{ $dailytask->manager ? $dailytask->manager->crud_name() : '-- --' }}</td>

                <td>{{ $dailytask->title }}</td>

                <td>{{ $dailytask->description }}</td>

                <td>{{ $dailytask->start_time }}</td>

                <td>{{ $dailytask->end_time }}</td>

                <td>{{ $dailytask->proearty }}</td>

                {{-- <td>{{ $dailytask->status }}</td> --}}

                <td>{{ $dailytask->repeat_time }}</td>

                <td>{{ $dailytask->repeat_evrey }}</td>


                <td>{{ $dailytask->created_at ? date('d/m/Y', strtotime($dailytask->created_at)) : '' }}</td>
                {{-- <td>{{ $dailytask->updated_at ? date('d/m/Y', strtotime($dailytask->updated_at)) : '' }}</td> --}}
                {{-- <td>{{ $dailytask->deleted_at ? date('d/m/Y', strtotime($dailytask->deleted_at)) : '' }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
