<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>device_info</td>

            <td>device_type</td>

            <td>application</td>

            <td>device_token</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($devicetokenlists as $devicetokenlist)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $devicetokenlist->id }}</td>
                <td>{{ $devicetokenlist->slug }}</td>


                <td>{{$devicetokenlist->user ? $devicetokenlist->user->crud_name():"-- -- " }}</td>

                <td>{{ $devicetokenlist->device_info }}</td>

                <td>{{ $devicetokenlist->device_type }}</td>

                <td>{{ $devicetokenlist->application }}</td>

                <td>{{ $devicetokenlist->device_token }}</td>


                <td>{{ $devicetokenlist->created_at ? date('d/m/Y', strtotime($devicetokenlist->created_at)) : '' }}
                </td>
                <td>{{ $devicetokenlist->updated_at ? date('d/m/Y', strtotime($devicetokenlist->updated_at)) : '' }}
                </td>
                <td>{{ $devicetokenlist->deleted_at ? date('d/m/Y', strtotime($devicetokenlist->deleted_at)) : '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
