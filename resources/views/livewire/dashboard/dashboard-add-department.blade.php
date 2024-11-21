<div class="col-md-3 col-6 mb-4 d-flex text-center justify-content-center ">
    <a wire:click="get_create_date()" href="#" data-toggle="modal" data-target="#create-new-department-modal"
        class="mouseHover col-md-12 py-3 px-1">
        <div class="col-md-12 d-flex justify-content-center pb-3">
            <img src="{{ asset('assets/dashboard/add.png') }}" width="32px" height="32px">
        </div>
        <div class="col-md-12 px-0 d-flex justify-content-center text-dark">{{ __('global.add-department') }}</div>
    </a>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <!-- Modal -->
    @permission('create-department')
        <div wire:ignore.self class="modal fade text-start" id="create-new-department-modal" data-backdrop="static"
            data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-new-department-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-new-department-modal-label">
                            {{ __('global.create-department') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">


                                @include('inputs.create.select', [
                                    'label' => 'department.branch',
                                    'name' => 'department.branch_id',
                                    'arr' => $branches,
                                    'livewire' => 'branch_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])



                                @include('inputs.create.select', [
                                    'label' => 'department.manager',
                                    'name' => 'department.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'department.name',
                                    'name' => 'department.name',
                                    'livewire' => 'name',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])



                            </div>

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
