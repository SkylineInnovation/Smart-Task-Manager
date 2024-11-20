<table>
    <thead>
        <tr>
            <td>#</td>
            <td>manager</td>
            <td>title</td>
            <td>desc</td>
            <td>start_time</td>
            <td>end_time</td>
            <td>comment_type</td>
            <td>max_worning_count</td>
            <td>priority_level</td>
            <td>status</td>
            <td>main_task</td>
            <td>created at</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td style="width: 20px ">{{ ++$number }}</td>
                <td style="width: 100pt">{{ $task->manager ? $task->manager->crud_name() : '-- --' }}</td>

                <td style="width: 100pt">{{ $task->title }}</td>

                <td class="w-100">{{ $task->desc }}</td>

                <td style="width: 100pt">{{ $task->start_time }}</td>

                <td style="width: 100pt">{{ $task->end_time }}</td>

                <td style="width: 100pt">{{ $task->comment_type }}</td>

                <td style="width: 100pt">{{ $task->max_worning_count }}</td>

                <td style="width: 100pt">{{ $task->the_priority_level() }}</td>

                <td style="width: 100pt">{{ $task->the_status() }}</td>

                <td style="width: 100pt">{{ $task->main_task ? $task->main_task->crud_name() : '-- --' }}</td>


                <td style="width: 100pt">{{ $task->created_at ? date('d/m/Y', strtotime($task->created_at)) : '' }}
                </td>
            </tr>

            @foreach ($task->comments as $tskCom)
                <tr>
                    <td colspan="0"></td>

                    <td colspan="3">{{ $tskCom->user->name() }}</td>
                    <td colspan="3">{{ $tskCom->title }}</td>
                    <td colspan="5">{{ $tskCom->desc }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
