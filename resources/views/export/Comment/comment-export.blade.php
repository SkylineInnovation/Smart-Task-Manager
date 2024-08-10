<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>task</td>
            <td>user</td>
            <td>title</td>

            <td>desc</td>

            <td>replay_time</td>

            <td>main_comment</td>

            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->slug }}</td>


                <td>{{ $comment->task->crud_name() }}</td>

                <td>{{ $comment->user->crud_name() }}</td>

                <td>{{ $comment->title }}</td>

                <td>{{ $comment->desc }}</td>

                <td>{{ $comment->replay_time }}</td>

                <td>{{ $comment->main_comment->crud_name() }}</td>


                <td>{{ $comment->created_at ? date('d/m/Y', strtotime($comment->created_at)) : '' }}</td>
                <td>{{ $comment->updated_at ? date('d/m/Y', strtotime($comment->updated_at)) : '' }}</td>
                <td>{{ $comment->deleted_at ? date('d/m/Y', strtotime($comment->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
