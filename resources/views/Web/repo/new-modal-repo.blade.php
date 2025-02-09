<!-- Modal p1-r1 -->
<div class="modal fade" id="repo-p1-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p1-r1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p1-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p1-r1Label">
                        {{ __('global.repo-p1-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">رقم المهمة</th>
                                <th scope="col"> عنوان المهمة</th>
                                <th scope="col">تحديد</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>checkbox</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

<!-- Modal p2-r1 -->
<div class="modal fade" id="repo-p2-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p2-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p2-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p2-r1Label">
                        {{ __('global.repo-p2-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">رقم المهمة</th>
                                <th scope="col">عنوان المهمة</th>
                                <th scope="col"> تحديد</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Radio buttons</td>


                            </tr>

                        </tbody>
                    </table>

                    <div class="col-12 w-100 m-0">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>


                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
                                <label for="">{{ __('global.to date') }}</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">

                                </div>
                                <input type="date" class="form-control" name="toDate" aria-label="Default"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>
