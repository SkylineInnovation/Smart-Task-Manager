<table>
    <thead>
        <tr>
            <td>#</td>
            <td>id</td>
            <td>slug</td>


            <td>name</td>

            <td>address</td>

            <td>phone</td>

            <td>number</td>

            <td>fax</td>

            <td>email</td>

            <td>website</td>

            <td>commercial_register</td>

            <td>technical_director</td>
            <td>financial_director</td>
            <td>logo</td>


            <td>created at</td>
            <td>updated at</td>
            <td>deleted at</td>

        </tr>
    </thead>

    <tbody>
        @foreach ($companys as $company)
            <tr>
                <td>{{ ++$number }}</td>
                <td>{{ $company->id }}</td>
                <td>{{ $company->slug }}</td>


                <td>{{ $company->name }}</td>

                <td>{{ $company->address }}</td>

                <td>{{ $company->phone }}</td>

                <td>{{ $company->number }}</td>

                <td>{{ $company->fax }}</td>

                <td>{{ $company->email }}</td>

                <td>{{ $company->website }}</td>

                <td>{{ $company->commercial_register }}</td>

                <td>{{ $company->technical_director->crud_name() }}</td>

                <td>{{ $company->financial_director->crud_name() }}</td>

                <td>{{ asset($company->logo) }}</td>


                <td>{{ $company->created_at ? date('d/m/Y', strtotime($company->created_at)) : '' }}</td>
                <td>{{ $company->updated_at ? date('d/m/Y', strtotime($company->updated_at)) : '' }}</td>
                <td>{{ $company->deleted_at ? date('d/m/Y', strtotime($company->deleted_at)) : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
