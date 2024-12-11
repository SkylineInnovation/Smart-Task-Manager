{{-- The best athlete wants his opponent at his best. --}}
<div class="col-md-3 col-6 mb-4 d-flex text-center justify-content-center ">
    <a wire:click="get_create_date()" href="#" data-toggle="modal" data-target="#create-new-leave-modal"
        class="mouseHover col-md-12 py-3 px-1">
        <div class="col-md-12 d-flex justify-content-center pb-3">
            <img src="{{ asset('assets/dashboard/add.png') }}" width="32px" height="32px">
        </div>
        <div class="col-md-12 px-0 d-flex justify-content-center text-dark">{{ __('global.submit-departure-form') }}
        </div>
    </a>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <!-- Modal -->
    @permission('create-leave')
        <div wire:ignore.self class="modal fade text-start" id="create-new-leave-modal" data-backdrop="static"
            data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-new-leave-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="create-new-leave-modal-label">
                            {{ __('global.submit-departure-form') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                            @csrf

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('leave.Leave type') }}</label>
                                        <select wire:model="leave_type" name="type" id="type" class="form-control">
                                            <option value="">{{ __('global.select') }}</option>
                                            <option value="leave">{{ __('leave.leave') }}</option>
                                            <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.create.input', [
                                    'label' => 'leave.time_out',
                                    'name' => 'leave.time_out',
                                    'livewire' => 'leave_time_out',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'leave.time_in',
                                    'name' => 'leave.time_in',
                                    'livewire' => 'leave_time_in',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 6,
                                ])

                                @include('inputs.textarea', [
                                    'label' => 'leave.reason',
                                    'livewire' => 'leave_reason',
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
