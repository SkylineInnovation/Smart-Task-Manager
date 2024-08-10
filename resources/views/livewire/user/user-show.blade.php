<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="card">

        <div class="form-horizontal">

            @csrf
            <div class="card-body">
                <div class="row">

                    @include('inputs.show.input', [
                        'label' => 'user.first_name',
                        'name' => 'first_name',
                        'val' => $user->crud_name(),
                    ])

                    {{-- @include('inputs.show.input', [
                        'label' => 'user.email',
                        'name' => 'email',
                        'val' => $user->email,
                        'lg' => 4,
                        'md' => 4,
                        'sm' => 6,
                    ]) --}}

                    @include('inputs.show.input', [
                        'label' => 'user.phone',
                        'name' => 'phone',
                        'val' => $user->email,
                    ])

                </div>

            </div>

        </div>

    </div>

</div>
