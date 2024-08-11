<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>task</td>
            <td>user</td>
            <td>type</td>

            <td>time_out</td>

            <td>time_in</td>

            <td>reason</td>

            <td>result</td>

            <td>status</td>

            <td>accepted_by_user</td>
            <td>accepted_time</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($leaves as $leave)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $leave->id }}</td>
                <td>{{ $leave->slug }}</td>


                <td>{{ $leave->task->crud_name() }}</td>

                <td>{{ $leave->user->crud_name() }}</td>

                <td>{{ $leave->type }}</td>

                <td>{{ $leave->time_out }}</td>

                <td>{{ $leave->time_in }}</td>

                <td>{{ $leave->reason }}</td>

                <td>{{ $leave->result }}</td>

                <td>{{ $leave->status }}</td>

                <td>{{ $leave->accepted_by_user->crud_name() }}</td>

                <td>{{ $leave->accepted_time }}</td>


                <td>{{ $leave->created_at ? date('d/m/Y', strtotime($leave->created_at)) : '' }}</td>
                <td>{{ $leave->updated_at ? date('d/m/Y', strtotime($leave->updated_at)) : '' }}</td>
                <td>{{ $leave->deleted_at ? date('d/m/Y', strtotime($leave->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
