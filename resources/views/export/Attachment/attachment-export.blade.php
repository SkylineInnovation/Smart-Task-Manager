<table>
    <thead>
        <tr>
            <td>#</td>
            {{-- <td>id</td>
            <td>slug</td> --}}


            <td>user</td>
            <td>task</td>
            <td>title</td>

            <td>desc</td>

            <td>file</td>

            <td>main_attachment</td>

            <td>created at</td>
            {{-- <td>updated at</td>
            <td>deleted at</td> --}}

        </tr>
    </thead>

    <tbody>
        @foreach ($attachments as $attachment)
            <tr>
                <td>{{ ++$number }}</td>
                {{-- <td>{{ $attachment->id }}</td>
                <td>{{ $attachment->slug }}</td> --}}


                <td>{{ $attachment->user ? $attachment->user->crud_name() : '-- --' }}</td>

                <td>{{ $attachment->task ? $attachment->task->crud_name() : '-- --' }}</td>

                <td>{{ $attachment->title }}</td>

                <td>{{ $attachment->desc }}</td>

                <td>{{ asset($attachment->file) }}</td>

                <td>{{ $attachment->main_attachment ? $attachment->main_attachment->crud_name() : '-- --' }}</td>


                <td>{{ $attachment->created_at ? date('d/m/Y', strtotime($attachment->created_at)) : '' }}</td>
                {{-- <td>{{ $attachment->updated_at ? date('d/m/Y', strtotime($attachment->updated_at)) : '' }}</td>
                <td>{{ $attachment->deleted_at ? date('d/m/Y', strtotime($attachment->deleted_at)) : '' }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
