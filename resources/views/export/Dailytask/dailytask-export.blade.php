<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>manager</td>
            <td>title</td>

            <td>description</td>

            <td>start_time</td>

            <td>end_time</td>

            <td>proearty</td>

            <td>status</td>

            <td>repeat_time</td>

            <td>repeat_evrey</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($dailytasks as $dailytask)
        <tr>
            <td>{{ ++$number }}</td>
            <td>{{ $dailytask->id }}</td>
            <td>{{ $dailytask->slug }}</td>


            <td>{{$dailytask->manager ? $dailytask->manager->crud_name() : "-- --" }}</td>

            <td>{{ $dailytask->title }}</td>

            <td>{{ $dailytask->description }}</td>

            <td>{{ $dailytask->start_time }}</td>

            <td>{{ $dailytask->end_time }}</td>

            <td>{{ $dailytask->proearty }}</td>

            <td>{{ $dailytask->status }}</td>

            <td>{{ $dailytask->repeat_time }}</td>

            <td>{{ $dailytask->repeat_evrey }}</td>


            <td>{{ $dailytask->created_at ? date('d/m/Y', strtotime($dailytask->created_at)) : '' }}</td>
            <td>{{ $dailytask->updated_at ? date('d/m/Y', strtotime($dailytask->updated_at)) : '' }}</td>
            <td>{{ $dailytask->deleted_at ? date('d/m/Y', strtotime($dailytask->deleted_at)) : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>