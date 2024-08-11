@extends('layouts.livewire-app')


@section('content')
    <div class="container bg-white-lightest ">
        <div class="d-flex card flex-row" style="overflow-x: scroll;">
            <div class="col-md-4 col-10  py-4 ">
                <h4 class="p-0 d-flex align-items-center  text-gray-400 fw-bold  justify-content-center">Pending</h4>
                <hr style="margin-top:0px !important ">

                <div class="col-md-12 col-12 p-0" style="">

                    <div class="card shadow-secondary p-0">

                        <div class="card-body p-0">
                            <div class="row w-100 m-0">
                                <div class="col-md-8 col-7 p-0 ">
                                    <div class="col-md-12  pt-4">
                                        <h4 class="px-4 text-bold">
                                            task name
                                        </h4>
                                    </div>
                                    <div class="col-md-12">
                                        <h6 class="text-gray px-4">
                                            {{ auth()->user()->crud_name() }}
                                        </h6>
                                    </div>
                                </div>


                                <div class="col-md-4 col-5 d-flex align-items-center p-0">
                                    <div class="row w-100 m-0 justify-content-md-around">
                                        <div class="col-md-3 col-4 d-flex justify-content-center fs-4 dropdown show">

                                            <a class="fa fa-cog text-secondarye" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">

                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fa fa-pencil-square-o text-secondarye"
                                                        aria-hidden="true"></i> &nbsp; Update</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-trash-o text-danger"
                                                        aria-hidden="true"></i> &nbsp; Delete</a>




                                            </div>
                                        </div>

                                        <div class="col-md-3 col-4 d-flex justify-content-center fs-4">



                                            <!-- Button trigger modal -->
                                            <button type="button" class="fa fa-exclamation-circle text-azure"
                                                ata-toggle="modal" data-target=".bd-example-modal-lg">

                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        ...
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-3 col-4 d-flex justify-content-center fs-4">
                                            <i class="fa fa-commenting-o text-danger"></i>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 pt-2">
                                    <h4 class="px-4 text-gray-400">
                                        users
                                    </h4>

                                    <div class="row w-100 m-0 py-3">
                                        <div class="col-md-3 col-4 d-flex justify-content-center">
                                            <img src="{{ asset('assets/images/users/1.jpg') }}"
                                                style="width: 40px !important ; ; border-radius: 100px" alt=""
                                                srcset="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 pt-2">
                                    <h4 class="px-4 text-gray-400">
                                        Status
                                    </h4>

                                    <div class="row w-100 m-0 py-3">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <select class="form-select bg-red-lighter" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 pt-2">
                                    <h4 class="px-4 text-gray-400">
                                        Priority
                                    </h4>

                                    <div class="row w-100 m-0 py-3">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <select class="form-select bg-gray-lighter" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row w-100 m-0 ">
                                        <div class="col-md-12 px-4 fs-5 text-gray-400">start at : April 05, 2024</div>
                                        <div class="col-md-12 px-4 fs-5 text-gray-400">start at : April 05, 2024</div>
                                        <small class="col-md-12 px-4 text-muted py-3">start at : April 05, 2024</small>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="col-md-4 text-center py-4 ">
                <h4 class="p-0 d-flex align-items-center  text-gray-400 fw-bold  justify-content-center">Active</h4>
                <hr style="margin-top:0px !important ">

            </div>
            <div class="col-md-4 text-center py-4 ">
                <h4 class="p-0 d-flex align-items-center  text-gray-400 fw-bold  justify-content-center">Auto finished</h4>
                <hr style="margin-top:0px !important ">

            </div>
            <div class="col-md-4 text-center py-4 ">
                <h4 class="p-0 d-flex align-items-center  text-gray-400 fw-bold  justify-content-center">Manual finished
                </h4>
                <hr style="margin-top:0px !important ">

            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- <script type="text/javascript">
        $(function() {
            var chartdata = [{
                name: "{!! __('global.users') !!}",
                type: 'line',
                smooth: true,
                data: {!! json_encode($userList) !!},
            }, ];
            // ['line', 'bar'];
            var chart = document.getElementById('home-echart');
            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '20',
                    right: '20',
                    bottom: '20',
                    left: '20',
                },
                xAxis: {
                    data: {!! json_encode($listOfDates) !!},
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(119, 119, 142, 0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#77778e'
                    }
                },
                tooltip: {
                    show: true,
                    showContent: true,
                    alwaysShowContent: true,
                    triggerOn: 'mousemove',
                    trigger: 'axis',
                    axisPointer: {
                        label: {
                            show: false
                        }
                    }
                },
                yAxis: {
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(119, 119, 142, 0.2)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(119, 119, 142, 0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#77778e'
                    }
                },
                series: chartdata,
                color: ['#0774f8', '#09ad95', '#d43f8d', ]
            };
            barChart.setOption(option);

        });
    </script> --}}
@endsection
