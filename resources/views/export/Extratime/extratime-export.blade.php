<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>task</td>
            <td>user</td>
            <td>accepted_by_user</td>
            <td>reason</td>

            <td>result</td>

            <td>request_time</td>

            <td>from_time</td>
            <td>to_time</td>

            <td>response_time</td>

            <td>status</td>

            <td>duration</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($extratimes as $extratime)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $extratime->id }}</td>
                <td>{{ $extratime->slug }}</td>


                <td>{{ $extratime->task->crud_name() }}</td>

                <td>{{ $extratime->user->crud_name() }}</td>

                <td>{{ $extratime->accepted_by_user->crud_name() }}</td>

                <td>{{ $extratime->reason }}</td>

                <td>{{ $extratime->result }}</td>

                <td>{{ $extratime->request_time }}</td>

                <td>{{ $extratime->from_time }}</td>
                <td>{{ $extratime->to_time }}</td>

                <td>{{ $extratime->response_time }}</td>

                <td>{{ $extratime->status }}</td>

                <td>{{ $extratime->duration }}</td>


                <td>{{ $extratime->created_at ? date('d/m/Y', strtotime($extratime->created_at)) : '' }}</td>
                <td>{{ $extratime->updated_at ? date('d/m/Y', strtotime($extratime->updated_at)) : '' }}</td>
                <td>{{ $extratime->deleted_at ? date('d/m/Y', strtotime($extratime->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
