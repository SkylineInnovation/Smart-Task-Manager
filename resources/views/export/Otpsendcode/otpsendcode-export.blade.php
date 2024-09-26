<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>otp_code</td>

            <td>phone_number</td>

            <td>applecation</td>

            <td>code_status</td>

            <td>back_response</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($otpsendcodes as $otpsendcode)
        <tr>
            <td>{{ ++$number }}</td>
            <td>{{ $otpsendcode->id }}</td>
            <td>{{ $otpsendcode->slug }}</td>


            <td>{{$otpsendcode->user ? $otpsendcode->user->crud_name() : '-- --' }}</td>

            <td>{{ $otpsendcode->otp_code }}</td>

            <td>{{ $otpsendcode->phone_number }}</td>

            <td>{{ $otpsendcode->applecation }}</td>

            <td>{{ $otpsendcode->code_status }}</td>

            <td>{{ $otpsendcode->back_response }}</td>


            <td>{{ $otpsendcode->created_at ? date('d/m/Y', strtotime($otpsendcode->created_at)) : '' }}</td>
            <td>{{ $otpsendcode->updated_at ? date('d/m/Y', strtotime($otpsendcode->updated_at)) : '' }}</td>
            <td>{{ $otpsendcode->deleted_at ? date('d/m/Y', strtotime($otpsendcode->deleted_at)) : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>