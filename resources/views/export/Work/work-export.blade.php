<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>manager</td>
            <td>department</td>
            <td>user</td>
            <td>job_title</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($works as $work)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $work->id }}</td>
                <td>{{ $work->slug }}</td>


                <td>{{ $work->manager->crud_name() }}</td>

                <td>{{ $work->department->crud_name() }}</td>

                <td>{{ $work->user->crud_name() }}</td>

                <td>{{ $work->job_title }}</td>


                <td>{{ $work->created_at ? date('d/m/Y', strtotime($work->created_at)) : '' }}</td>
                <td>{{ $work->updated_at ? date('d/m/Y', strtotime($work->updated_at)) : '' }}</td>
                <td>{{ $work->deleted_at ? date('d/m/Y', strtotime($work->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
