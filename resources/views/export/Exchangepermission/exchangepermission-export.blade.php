<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>content</td>

            <td>amount</td>

            <td>attachment</td>

            <td>request_date</td>

            <td>financial_director</td>
            <td>financial_director_response</td>

            <td>financial_director_time</td>

            <td>technical_director</td>
            <td>technical_director_response</td>

            <td>technical_director_time</td>

            <td>status</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($exchangepermissions as $exchangepermission)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $exchangepermission->id }}</td>
                <td>{{ $exchangepermission->slug }}</td>


                <td>{{ $exchangepermission->user->crud_name() }}</td>

                <td>{{ $exchangepermission->content }}</td>

                <td>{{ $exchangepermission->amount }}</td>

                <td>{{ asset($exchangepermission->attachment) }}</td>

                <td>{{ $exchangepermission->request_date }}</td>

                <td>{{ $exchangepermission->financial_director->crud_name() }}</td>

                <td>{{ $exchangepermission->financial_director_response }}</td>

                <td>{{ $exchangepermission->financial_director_time }}</td>

                <td>{{ $exchangepermission->technical_director->crud_name() }}</td>

                <td>{{ $exchangepermission->technical_director_response }}</td>

                <td>{{ $exchangepermission->technical_director_time }}</td>

                <td>{{ $exchangepermission->status }}</td>


                <td>{{ $exchangepermission->created_at ? date('d/m/Y', strtotime($exchangepermission->created_at)) : '' }}
                </td>
                <td>{{ $exchangepermission->updated_at ? date('d/m/Y', strtotime($exchangepermission->updated_at)) : '' }}
                </td>
                <td>{{ $exchangepermission->deleted_at ? date('d/m/Y', strtotime($exchangepermission->deleted_at)) : '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
