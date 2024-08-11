<div>
    <div class="row w-100 m-0">
        <div class="col-lg-4 col-md-6 col-sm-12 ">
            <a class="card bg-primary img-card box-primary-shadow " data-toggle="modal" data-target=".bd-example-modal-lg">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">
                                {{ __('global.create task') }}
                            </h2>

                        </div>
                        <div class="ml-auto">
                            <i class="fa fa-tasks text-white fs-30 mr-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('global.creat task') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row w-100 m-0">


                        <div class="form-group col-md-6">
                            <label>Select User</label>
                            <select wire:model.defer="selectedUsers" multiple="multiple" class="filter-multi">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">proearty</label>
                            <select wire:model.defer="priority_level" class="form-control">
                                <option>low</option>
                                <option>medum</option>
                                <option>high</option>

                            </select>
                        </div>

                        <div class="input-group mb-3 col-md-8">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('global.title') }}</span>
                            </div>
                            <input wire:model.defer="title" type="text" multiple class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3 col-md-4">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('global.descount') }}</span>
                            </div>
                            <input wire:model.defer="discount" type="number" class="form-control" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>



                        <div class="input-group mb-3  col-md-6">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('global.start date') }}</span>
                            </div>
                            <input wire:model.defer="start_date" type="datetime-local" class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3  col-md-6">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('global.end date') }}</span>
                            </div>
                            <input wire:model.defer="end_date" type="datetime-local" class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>


                        <div wire:ignore.self class="col-md-12">
                            <label>Description</label>
                            <div wire:model.defer="description" id="summernote"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="createTask()" type="submit" class="btn btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
