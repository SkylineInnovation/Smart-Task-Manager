<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>manager</td>
            <td>title</td>

            <td>desc</td>

            <td>start_time</td>

            <td>end_time</td>

            <td>priority_level</td>

            <td>status</td>

            <td>main_task</td>

            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $task->id }}</td>
                <td>{{ $task->slug }}</td>


                <td>{{ $task->manager->crud_name() }}</td>

                <td>{{ $task->title }}</td>

                <td>{{ $task->desc }}</td>

                <td>{{ $task->start_time }}</td>

                <td>{{ $task->end_time }}</td>

                <td>{{ $task->priority_level }}</td>

                <td>{{ $task->status }}</td>

                <td>{{ $task->main_task->crud_name() }}</td>


                <td>{{ $task->created_at ? date('d/m/Y', strtotime($task->created_at)) : '' }}</td>
                <td>{{ $task->updated_at ? date('d/m/Y', strtotime($task->updated_at)) : '' }}</td>
                <td>{{ $task->deleted_at ? date('d/m/Y', strtotime($task->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
