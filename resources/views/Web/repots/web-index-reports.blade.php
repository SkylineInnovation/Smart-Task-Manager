@extends('layouts.livewire-app')
<!-- jQuery (required for Bootstrap and Bootstrap Select) -->

<!-- Bootstrap JS -->


@section('css')
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
@endsection


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
                    <a href="" data-toggle="modal" data-target="#important-comments"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.important-comments') }}
                        </div>
                    </a>
                </div>



                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#Task-specific-comments"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.Task-specific-comments') }}
                        </div>
                    </a>
                </div>

                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#Incoming-Discounts-Report"
                        class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.Incoming-Discounts-Report') }}
                        </div>
                    </a>
                </div>


                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#tasks-Short-Desc" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.tasks-Short-Desc') }}
                        </div>
                    </a>
                </div>


                <div class="col-md-2  d-flex justify-content-center">
                    <a href="" data-toggle="modal" data-target="#employeeFollowUp" class="mouseHover col-md-11 py-3">
                        <div class="col-md-12 pb-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/dashboard/report-one.png') }}" width="72" height="72"
                                alt="">
                        </div>
                        <div class="col-md-12 text-center text-dark text-bold">
                            {{ __('global.employeeFollowUp') }}
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
                            {{ __('global.IncomingTaskMovements') }}
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
                            {{ __('global.OutgoingTaskMovements') }}
                        </div>
                    </a>
                </div>

                {{-- <div class="col-md-2  d-flex justify-content-center">
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

    @include('web.repots.reports-model')
@endsection

@section('js')
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

        function filterTable2() {
            // Get search input value
            const input = document.getElementById('searchInput2');
            const filter = input.value.toLowerCase();
            const tableBody = document.getElementById('tableBody2');
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

        function filterTable3() {
            // Get search input value
            const input = document.getElementById('searchInput3');
            const filter = input.value.toLowerCase();
            const tableBody = document.getElementById('tableBody3');
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


        function filterTable4() {
            // Get search input value
            const input = document.getElementById('searchInput4');
            const filter = input.value.toLowerCase();
            const tableBody = document.getElementById('tableBody4');
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


        function filterTable5() {
            // Get the search input value and convert it to lowercase for case-insensitive comparison
            let input = document.getElementById("searchInput5");
            let filter = input.value.toLowerCase();
            let tableBody = document.getElementById("tableBody5");
            let rows = tableBody.getElementsByTagName("tr");

            // Loop through table rows
            for (let i = 0; i < rows.length; i++) {
                let cols = rows[i].getElementsByTagName("td");
                let rowContent = "";

                // Concatenate all column text values in the row
                for (let j = 0; j < cols.length - 1; j++) { // Excluding the last column for the radio button
                    rowContent += cols[j].innerText.toLowerCase() + " ";
                }

                // Check if row matches the filter
                if (rowContent.indexOf(filter) > -1) {
                    rows[i].style.display = ""; // Show row
                } else {
                    rows[i].style.display = "none"; // Hide row
                }
            }
        }

        function filterTable6() {
            // Get the search input value and convert it to lowercase for case-insensitive comparison
            let input = document.getElementById("searchInput6");
            let filter = input.value.toLowerCase();
            let tableBody = document.getElementById("tableBody6");
            let rows = tableBody.getElementsByTagName("tr");

            // Loop through table rows
            for (let i = 0; i < rows.length; i++) {
                let cols = rows[i].getElementsByTagName("td");
                let rowContent = "";

                // Concatenate all column text values in the row
                for (let j = 0; j < cols.length - 1; j++) { // Excluding the last column for the radio button
                    rowContent += cols[j].innerText.toLowerCase() + " ";
                }

                // Check if row matches the filter
                if (rowContent.indexOf(filter) > -1) {
                    rows[i].style.display = ""; // Show row
                } else {
                    rows[i].style.display = "none"; // Hide row
                }
            }
        }
    </script>
@endsection
