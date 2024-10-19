<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>manager</td>
            <td>name</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $department->id }}</td>
                <td>{{ $department->slug }}</td>


                <td>{{ $department->manager->crud_name() }}</td>

                <td>{{ $department->name }}</td>


                <td>{{ $department->created_at ? date('d/m/Y', strtotime($department->created_at)) : '' }}</td>
                <td>{{ $department->updated_at ? date('d/m/Y', strtotime($department->updated_at)) : '' }}</td>
                <td>{{ $department->deleted_at ? date('d/m/Y', strtotime($department->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
