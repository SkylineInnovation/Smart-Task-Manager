<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>title</td>

            <td>nationality</td>

            <td>id_number</td>

            <td>address</td>

            <td>qualification</td>

            <td>salary</td>

            <td>home</td>

            <td>transport</td>

            <td>branch</td>

            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($userdetails as $userdetail)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $userdetail->id }}</td>
                <td>{{ $userdetail->slug }}</td>


                <td>{{ $userdetail->user->crud_name() }}</td>

                <td>{{ $userdetail->title }}</td>

                <td>{{ $userdetail->nationality }}</td>

                <td>{{ $userdetail->id_number }}</td>

                <td>{{ $userdetail->address }}</td>

                <td>{{ $userdetail->qualification }}</td>

                <td>{{ $userdetail->salary }}</td>

                <td>{{ $userdetail->home }}</td>

                <td>{{ $userdetail->transport }}</td>

                <td>{{ $userdetail->branch->crud_name() }}</td>


                <td>{{ $userdetail->created_at ? date('d/m/Y', strtotime($userdetail->created_at)) : '' }}</td>
                <td>{{ $userdetail->updated_at ? date('d/m/Y', strtotime($userdetail->updated_at)) : '' }}</td>
                <td>{{ $userdetail->deleted_at ? date('d/m/Y', strtotime($userdetail->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
