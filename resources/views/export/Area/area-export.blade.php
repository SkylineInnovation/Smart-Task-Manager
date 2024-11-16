<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>name</td>

            <td>location</td>

            <td>manager</td>

            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($areas as $area)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $area->id }}</td>
                <td>{{ $area->slug }}</td>


                <td>{{ $area->name }}</td>

                <td>{{ $area->location }}</td>

                <td>{{ $area->manager->crud_name() }}</td>


                <td>{{ $area->created_at ? date('d/m/Y', strtotime($area->created_at)) : '' }}</td>
                <td>{{ $area->updated_at ? date('d/m/Y', strtotime($area->updated_at)) : '' }}</td>
                <td>{{ $area->deleted_at ? date('d/m/Y', strtotime($area->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
