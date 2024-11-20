<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>

            
                    <td>task</td>
                    <td>user</td>
                    <td>percentage</td>

                    <td>rate_text</td>

                    <td>rate_val</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($completepercentages as $completepercentage)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $completepercentage->id }}</td>
                <td>{{ $completepercentage->slug }}</td>

                
                    <td>{{ $completepercentage->task->crud_name() }}</td>

                    <td>{{ $completepercentage->user->crud_name() }}</td>

                    <td>{{ $completepercentage->percentage }}</td>

                    <td>{{ $completepercentage->rate_text }}</td>

                    <td>{{ $completepercentage->rate_val }}</td>


                <td>{{ $completepercentage->created_at ? date('d/m/Y', strtotime($completepercentage->created_at)) : '' }}</td>
                <td>{{ $completepercentage->updated_at ? date('d/m/Y', strtotime($completepercentage->updated_at)) : '' }}</td>
                <td>{{ $completepercentage->deleted_at ? date('d/m/Y', strtotime($completepercentage->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
