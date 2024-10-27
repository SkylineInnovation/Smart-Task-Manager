<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>name</td>

            <td>location</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($branchs as $branch)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $branch->id }}</td>
                <td>{{ $branch->slug }}</td>


                <td>{{ $branch->name }}</td>

                <td>{{ $branch->location }}</td>


                <td>{{ $branch->created_at ? date('d/m/Y', strtotime($branch->created_at)) : '' }}</td>
                <td>{{ $branch->updated_at ? date('d/m/Y', strtotime($branch->updated_at)) : '' }}</td>
                <td>{{ $branch->deleted_at ? date('d/m/Y', strtotime($branch->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
