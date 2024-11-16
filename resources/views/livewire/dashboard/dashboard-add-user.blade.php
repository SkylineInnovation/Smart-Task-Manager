<div class="col-md-3  col-6 mb-4 d-flex justify-content-center ">
    {{-- Because she competes with no one, no one can compete with her. --}}

    <a data-toggle="modal" data-target="#create-new-user-modal" class="mouseHover col-md-12 py-3 px-1">
        <div class="col-md-12 d-flex justify-content-center pb-3"><img src="{{ asset('assets/dashboard/add.png') }}"
                width="72px" height="72px" alt=""></div>
        <div class="col-md-12 px-0 d-flex justify-content-center text-dark">{{ __('global.add-user') }}</div>
    </a>

    @permission('create-user')
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="create-new-user-modal" data-backdrop="static" data-keyboard="false"
            tabindex="-1" role="dialog" aria-labelledby="create-new-user-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-new-user-modal-label">
                            {{ __('global.create-user') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.title',
                                    'name' => 'userdetail.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'user.first_name',
                                    'name' => 'user.first_name',
                                    'livewire' => 'first_name',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'user.last_name',
                                    'name' => 'last_name',
                                    'livewire' => 'last_name',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'user.email',
                                    'name' => 'email',
                                    'livewire' => 'email',
                                    'type' => 'email',
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'user.phone',
                                    'name' => 'phone',
                                    'livewire' => 'phone',
                                    'type' => 'tel',
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'user.password',
                                    'name' => 'password',
                                    'livewire' => 'password',
                                    // 'type' => 'password',
                                    'lg' => 12,
                                    'md' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.nationality',
                                    'name' => 'userdetail.nationality',
                                    'livewire' => 'nationality',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 6,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.id_number',
                                    'name' => 'userdetail.id_number',
                                    'livewire' => 'id_number',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 6,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'userdetail.address',
                                    'name' => 'userdetail.address',
                                    'livewire' => 'address',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 6,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.qualification',
                                    'name' => 'userdetail.qualification',
                                    'livewire' => 'qualification',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 6,
                                ])

                                {{--  --}}

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.salary',
                                    'name' => 'userdetail.salary',
                                    'livewire' => 'salary',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.home',
                                    'name' => 'userdetail.home',
                                    'livewire' => 'home',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'userdetail.transport',
                                    'name' => 'userdetail.transport',
                                    'livewire' => 'transport',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'userdetail.branch',
                                    'name' => 'userdetail.branch_id',
                                    'arr' => $branches,
                                    'livewire' => 'branch_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                            </div>

                            @role('owner')
                                <div>
                                    <p>{{ __('global.roles') }}</p>
                                    <div class="row">
                                        @foreach ($roles as $role)
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <input wire:model='selectedRoles' class="form-check-input" type="checkbox"
                                                        value="{{ $role->id }}" id="selected-role-{{ $role->id }}">
                                                    <label class="form-check-label" for="selected-role-{{ $role->id }}">
                                                        {{ $role->display_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endrole

                        </div>

                        <div class="form-group">

                            @foreach ($errors->all() as $error)
                                <span class='alert alert-danger btn'>{{ $error }}</span>
                            @endforeach

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                                {{ __('global.close') }}
                            </button>
                            <button type="submit" wire:click.prevent="store()" class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    @endpermission
</div>
