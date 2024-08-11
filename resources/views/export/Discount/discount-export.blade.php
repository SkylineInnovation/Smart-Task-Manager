<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>task</td>
            <td>user</td>
            <td>amount</td>

            <td>reason</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($discounts as $discount)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->slug }}</td>


                <td>{{ $discount->task->crud_name() }}</td>

                <td>{{ $discount->user->crud_name() }}</td>

                <td>{{ $discount->amount }}</td>

                <td>{{ $discount->reason }}</td>


                <td>{{ $discount->created_at ? date('d/m/Y', strtotime($discount->created_at)) : '' }}</td>
                <td>{{ $discount->updated_at ? date('d/m/Y', strtotime($discount->updated_at)) : '' }}</td>
                <td>{{ $discount->deleted_at ? date('d/m/Y', strtotime($discount->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
