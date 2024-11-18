<!-- teaskModelReport -->
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="teaskModelReport" tabindex="-1"
    role="dialog" aria-labelledby="teaskModelReportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form action="{{ route('task.commintes.report') }}" method="post">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="teaskModelReportLabel">{{ __('Task Comments Report') }}</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-end"><label for="">{{ __('global.from date ') }}</label></div>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                id="inputGroup-sizing-default">{{ __('global.Gregorian') }}</span>
                        </div>
                        <input type="date" id="" name="fromDate" class="form-control" aria-label="Default"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="text-end"><label for="">{{ __('global.to date') }}</label></div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                id="inputGroup-sizing-default">{{ __('global.Gregorian') }}</span>
                        </div>
                        <input type="date" class="form-control" name="toDate" aria-label="Default"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end teask Model Report --}}

<!-- Closed task soon ModelReport -->
<div class="modal fade" id="closedTaskComingSoonReport" tabindex="-1" role="dialog"
    aria-labelledby="closedTaskComingSoonReportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closedTaskComingSoonReportLabel">{{ __(' closed Task Coming Soon Report') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                closed Task Coming Soon Report
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end closed  task soon Model Report --}}
<!-- Closed task soon ModelReport -->
<div class="modal fade" id="OutgoingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="OutgoingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OutgoingTaskMovementsLabel">{{ __(' Outgoing Task Movements') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Outgoing Task Movements
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end closed  task soon Model Report --}}


<!-- Incoming Task Movements ModelReport -->
<div class="modal fade" id="IncomingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="IncomingTaskMovementsLabel">{{ __(' Incoming Task Movements') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Incoming Task Movements
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- Incoming Task Movements Model Report --}}


<!-- OutgoingTaskDiscounts ModelReport -->
<div class="modal fade" id="OutgoingTaskDiscounts" tabindex="-1" role="dialog"
    aria-labelledby="OutgoingTaskDiscountsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OutgoingTaskDiscountsLabel">{{ __(' Outgoing Task Discounts') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Outgoing Task Discounts
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end OutgoingTaskDiscounts Model Report --}}


<!-- IncomingTaskDiscounts ModelReport -->
<div class="modal fade" id="IncomingTaskDiscounts" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskDiscountsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="IncomingTaskDiscountsLabel">{{ __('Incoming Task Discounts') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Incoming Task Discounts
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end IncomingTaskDiscounts Model Report --}}


<!-- FollowUpEmployeeTasks ModelReport -->
<div class="modal fade" id="FollowUpEmployeeTasks" tabindex="-1" role="dialog"
    aria-labelledby="FollowUpEmployeeTasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FollowUpEmployeeTasksLabel">{{ __('Follow Up Employee Tasks') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Follow Up Employee Tasks
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end FollowUpEmployeeTasks Model Report --}}
