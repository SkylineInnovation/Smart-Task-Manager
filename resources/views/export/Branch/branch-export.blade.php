<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>name</td>

            <td>location</td>

            <td>phone</td>

            <td>number</td>

            <td>fax</td>

            <td>email</td>

            <td>password</td>

            <td>website</td>

            <td>commercial_register</td>

            <td>area</td>
            <td>manager</td>
            <td>responsible</td>

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

                <td>{{ $branch->phone }}</td>

                <td>{{ $branch->number }}</td>

                <td>{{ $branch->fax }}</td>

                <td>{{ $branch->email }}</td>

                <td>{{ $branch->password }}</td>

                <td>{{ $branch->website }}</td>

                <td>{{ $branch->commercial_register }}</td>

                <td>{{ $branch->area->crud_name() }}</td>

                <td>{{ $branch->manager->crud_name() }}</td>

                <td>{{ $branch->responsible->crud_name() }}</td>


                <td>{{ $branch->created_at ? date('d/m/Y', strtotime($branch->created_at)) : '' }}</td>
                <td>{{ $branch->updated_at ? date('d/m/Y', strtotime($branch->updated_at)) : '' }}</td>
                <td>{{ $branch->deleted_at ? date('d/m/Y', strtotime($branch->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
