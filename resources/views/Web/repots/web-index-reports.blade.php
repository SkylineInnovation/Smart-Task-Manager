<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

<!-- Bootstrap Select CSS -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

@extends('layouts.livewire-app')
<!-- jQuery (required for Bootstrap and Bootstrap Select) -->

<!-- Bootstrap JS -->

<style>
    .mouseHover:hover {
        drop-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

    .borderColorGreen {
        border-top: #1EAE9A solid 5px
    }

    .borderColorRed {
        border-top: #E04B4A solid 5px
    }
</style>




@section('content')
    <div class="card ">
        <div class="card-header bg-dark text-light borderColorGreen">
            <div class="col-md-12 ">
                <h4 class="text-{{ App::getLocale() == 'en' ? 'center' : 'center' }}">
                    {{ __('global.reports') }}
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row w-100 m-0">

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#OutgoingTaskDiscounts"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.outgoing-task-discounts') }}
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#commintsInAllTasks"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.commints-in-all-tasks') }}
                        </div>
                    </a>
                </div>


                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#teaskModelReport" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.task-omments-report') }}
                        </div>
                    </a>
                </div>

                {{-- <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#closedTaskComingSoonReport"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.closed-tasks-coming-soon') }}
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#OutgoingTaskMovements"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.outgoing-task-movements') }}
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#IncomingTaskMovements"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.incoming-task-movements') }}
                        </div>
                    </a>
                </div> --}}



                {{-- <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#IncomingTaskDiscounts"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.incoming-task-discounts') }}
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#FollowUpEmployeeTasks"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.follow-up-employee-tasks') }}
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>

    @include('Web.repots.reports-model')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>


   <script>
    function filterTable() {
        // Get search input value
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.getElementsByTagName('tr');

        // Loop through all table rows
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let rowContainsFilter = false;

            // Check each cell in the row
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(filter)) {
                    rowContainsFilter = true;
                    break;
                }
            }

            // Show or hide the row based on the filter
            rows[i].style.display = rowContainsFilter ? '' : 'none';
        }
    }
</script>
@endsection
