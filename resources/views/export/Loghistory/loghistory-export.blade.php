<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>user</td>
            <td>action</td>
            <td>by_model_name</td>

            <td>by_model_id</td>

            <td>on_model_name</td>

            <td>on_model_id</td>

            <td>from_data</td>

            <td>to_data</td>

            <td>preaf</td>

            <td>desc</td>

            <td>color</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($loghistorys as $loghistory)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $loghistory->id }}</td>
                <td>{{ $loghistory->slug }}</td>


                <td>{{ $loghistory->user->crud_name() }}</td>

                <td>{{ $loghistory->action }}</td>
                <td>{{ $loghistory->by_model_name }}</td>

                <td>{{ $loghistory->by_model_id }}</td>

                <td>{{ $loghistory->on_model_name }}</td>

                <td>{{ $loghistory->on_model_id }}</td>

                <td>{{ $loghistory->from_data }}</td>

                <td>{{ $loghistory->to_data }}</td>

                <td>{{ $loghistory->preaf }}</td>

                <td>{{ $loghistory->desc }}</td>

                <td>{{ $loghistory->color }}</td>


                <td>{{ $loghistory->created_at ? date('d/m/Y', strtotime($loghistory->created_at)) : '' }}</td>
                <td>{{ $loghistory->updated_at ? date('d/m/Y', strtotime($loghistory->updated_at)) : '' }}</td>
                <td>{{ $loghistory->deleted_at ? date('d/m/Y', strtotime($loghistory->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
