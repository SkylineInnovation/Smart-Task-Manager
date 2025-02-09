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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">رقم المهمة</th>
                                <th colspan="3" scope="col"> عنوان المهمة</th>
                                <th colspan="1" scope="col">تحديد</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td colspan="3">Mark</td>
                                <td colspan="1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">

                                    </div>
                                </td>

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
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="exampleRadios1" value="option1" checked>

                                    </div>
                                </td>


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


<!-- Modal p2-r2 -->
<div class="modal fade" id="repo-p2-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p2-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p2-r2-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p2-r2Label">
                        {{ __('global.repo-p2-r2') }}</h5>
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
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">

                                    </div>
                                </td>


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

<!-- Modal p4-r1 -->
<div class="modal fade" id="repo-p4-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p4-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p4-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p4-r1Label">
                        {{ __('global.repo-p4-r1') }}</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
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


<!-- Modal p4-r2 -->
<div class="modal fade" id="repo-p4-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p4-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p4-r2-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p4-r2Label">
                        {{ __('global.repo-p4-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    {{-- <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">رقم المهمة</th>
                                <th scope="col">عنوان المهمة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                            </tr>

                        </tbody>
                    </table> --}}

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


<!-- Modal p6-r1 -->
<div class="modal fade" id="repo-p6-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p6-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p6-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p6-r1Label">
                        {{ __('global.repo-p6-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">


                    <div class="form-group">
                        <label for="browser">حساب الموظف</label>
                        <input class="form-control" list="browsers" id="browser" name="browser"
                            placeholder="Type to search...">
                        <datalist id="browsers">
                            <option value="Chrome">
                            <option value="Firefox">
                            <option value="Safari">
                            <option value="Edge">
                            <option value="Opera">
                            <option value="Brave">
                        </datalist>
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


<!-- Modal p6-r2 -->
<div class="modal fade" id="repo-p6-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p6-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p6-r2-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p6-r2Label">
                        {{ __('global.repo-p6-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">


                    <div class="form-group">
                        <label for="browser">حساب جهة التكليف</label>
                        <input class="form-control" list="browsers" id="browser" name="browser"
                            placeholder="Type to search...">
                        <datalist id="browsers">
                            <option value="Chrome">
                            <option value="Firefox">
                            <option value="Safari">
                            <option value="Edge">
                            <option value="Opera">
                            <option value="Brave">
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">عنوان التقرير</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="حركة المهام الصادرة">
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


<!-- Modal p8-r1 -->
<div class="modal fade" id="repo-p8-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p8-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p8-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p8-r1Label">
                        {{ __('global.repo-p8-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">


                    <div class="form-group">
                        <label for="browser">حساب الموظف </label>
                        <input class="form-control" list="browsers" id="browser" name="browser"
                            placeholder="Type to search...">
                        <datalist id="browsers">
                            <option value="Chrome">
                            <option value="Firefox">
                            <option value="Safari">
                            <option value="Edge">
                            <option value="Opera">
                            <option value="Brave">
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">عنوان التقرير</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="حركة المهام الواردة">
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

<!-- Modal p8-r2 -->
<div class="modal fade" id="repo-p8-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p8-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p8-r2-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p8-r2Label">
                        {{ __('global.repo-p8-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">


                    <div class="form-group">
                        <label for="browser">حساب جهة التكليف</label>
                        <input class="form-control" list="browsers" id="browser" name="browser"
                            placeholder="Type to search...">
                        <datalist id="browsers">
                            <option value="Chrome">
                            <option value="Firefox">
                            <option value="Safari">
                            <option value="Edge">
                            <option value="Opera">
                            <option value="Brave">
                        </datalist>
                    </div>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <div class="row w-100 m-0 mt-4">
                        <div class="col-md-6 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>


                        </div>
                        <div class="col-md-6 px-1">
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

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">عنوان التقرير</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="خصومات  المهام الصادرة">
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

<!-- Modal p10-r1 -->
<div class="modal fade" id="repo-p10-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p10-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p10-r1-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p10-r1Label">
                        {{ __('global.repo-p10-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <table class="table  table-bordered">
                        <thead>
                            <tr>

                                <th scope="col"> اسم الموظف</th>
                                <th scope="col"> تحديد</th>



                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>Mark</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">

                                    </div>
                                </td>


                            </tr>

                        </tbody>
                    </table>

                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <div class="row w-100 m-0 mt-4">
                        <div class="col-md-6 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>


                        </div>
                        <div class="col-md-6 px-1">
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

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">عنوان التقرير</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="خصومات  المهام الواردة">
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


<!-- Modal p11 -->
<div class="modal fade" id="repo-p11" tabindex="-1" role="dialog" aria-labelledby="repo-p11Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p11-table') }}" method="get">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p11Label">
                        {{ __('global.repo-p11') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="form-group">
                        <label for="browser">حساب الموظف </label>
                        <input class="form-control" list="browsers" id="browser" name="browser"
                            placeholder="Type to search...">
                        <datalist id="browsers">
                            <option value="Chrome">
                            <option value="Firefox">
                            <option value="Safari">
                            <option value="Edge">
                            <option value="Opera">
                            <option value="Brave">
                        </datalist>
                    </div>




                    <div class="col-12 w-100 m-0 mt-4">
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
