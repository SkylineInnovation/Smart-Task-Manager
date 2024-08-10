<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>code</td>

            <td>note</td>

            <td>is_used</td>

            <td>ip_address</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($passwordcodes as $passwordcode)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $passwordcode->id }}</td>
                <td>{{ $passwordcode->slug }}</td>


                <td>{{ $passwordcode->user->crud_name() }}</td>

                <td>{{ $passwordcode->code }}</td>

                <td>{{ $passwordcode->note }}</td>

                <td>{{ $passwordcode->is_used }}</td>

                <td>{{ $passwordcode->ip_address }}</td>


                <td>{{ $passwordcode->created_at ? date('d/m/Y', strtotime($passwordcode->created_at)) : '' }}</td>
                <td>{{ $passwordcode->updated_at ? date('d/m/Y', strtotime($passwordcode->updated_at)) : '' }}</td>
                <td>{{ $passwordcode->deleted_at ? date('d/m/Y', strtotime($passwordcode->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
