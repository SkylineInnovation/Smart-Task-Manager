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
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">select</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>

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
