<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="userprofile">
                            <div class="userpic brround">
                                <img src="{{ asset($user->image) }}" class="userpic brround" alt="{{ $user->name() }}">
                            </div>
                            <h3 class="username text-dark mb-2">{{ $user->name() }}</h3>
                            <p class="mb-1 text-muted">{{ $user->rolesSideBySide() }}</p>
                            {{-- <div class="text-center mb-4">
                                <span><i class="fa fa-star text-warning"></i></span>
                                <span><i class="fa fa-star-half-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}

        <div class="col-lg-9 col-md-12 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="form-horizontal">
                    <div class="card-body">
                        <div class="row">
                            @include('inputs.show.input', [
                                'label' => 'user.name',
                                'name' => 'name',
                                'val' => $user->crud_name(),
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 6,
                            ])

                            @include('inputs.show.input', [
                                'label' => 'user.email',
                                'name' => 'email',
                                'val' => $user->email,
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 6,
                            ])

                            @include('inputs.show.input', [
                                'label' => 'user.phone',
                                'name' => 'phone',
                                'val' => $user->phone,
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 12,
                            ])

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-2">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="from_date">{{ __('global.from_date') }}</label>
                        <input type="date" wire:model="from_date" name="from_date" id="from_date"
                            class="form-control" placeholder="from date">
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="to_date">{{ __('global.to_date') }}</label>
                        <input type="date" wire:model="to_date" name="to_date" id="to_date" class="form-control"
                            placeholder="to date">
                    </div>
                </div>

                <div class="col-2">
                    <label for="to_date">{{ __('global.restart_filter') }}</label>
                    <button type="button" wire:click.prevent="clear()" class="btn btn-danger w-100">
                        {{ __('global.clear') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Tasks_Time') }}</h6>
                    <h2 class="mb-2 number-font">{{ $totalTaskWork }}</h2>
                    <p class="text-muted">{{ __('task.Total_Work_Hours_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Task_Count') }}</h6>
                    <h2 class="mb-2 number-font">{{ $totalTaskSum }}</h2>
                    <p class="text-muted">{{ __('task.Total_Task_Count_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Finished_Tasks') }}</h6>
                    <h2 class="mb-2 number-font">{{ $autoFinishedTaskSum }}</h2>
                    <p class="text-muted">{{ __('task.Total_Task_Count_Finished_By_System') }}</p>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Completed_Task') }}</h6>
                    <h2 class="mb-2 number-font">{{ $completedTaskSum }}</h2>
                    <p class="text-muted">{{ __('task.Total_Completed_Task_Count_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="task-echart" class="chart-donut chart-dropshadow"></div>
                </div>
                <div class="card-footer">
                    <div class="mt-4" style="direction: @if (App::getLocale() == 'ar') rtl @else ltr @endif">
                        <span class="ml-5">
                            <span style="background-color: #0774f8;" class="dot-label me-1"></span>
                            {{ __('global.total') }}
                            <span style="background-color: #09ad95;" class="dot-label me-1 ms-4"></span>
                            {{ __('global.auto') }}
                            <span style="background-color: #d43f8d;" class="dot-label me-1 ms-4"></span>
                            {{ __('global.completed') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center">
                    <div id="task-morrisBar8-don" class="donutShadow" style="height: 200px">
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Extra_Time') }}</h6>
                    <h2 class="mb-2 number-font">{{ $totalExtraTimeWork }}</h2>
                    <p class="text-muted">{{ __('task.Total_Extra_Time_Hours_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Leave_Hour') }}</h6>
                    <h2 class="mb-2 number-font">{{ $totalLeaveWork }}</h2>
                    <p class="text-muted">{{ __('task.Total_Leave_Hours_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-lg-4 col-md-12 col-sm-12 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center statistics-info">
                    <div class="counter-icon bg-primary mb-0 box-primary-shadow">
                        <i class="fe fe-trending-up text-white"></i>
                    </div>
                    <h6 class="mt-4 mb-1">{{ __('task.Total_Discount') }}</h6>
                    <h2 class="mb-2 number-font">{{ $totalDiscountAmount }}</h2>
                    <p class="text-muted">{{ __('task.Total_Discount_in_Selected_Duration') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ __('task.Leaves_&_Extra_Time') }}
        </div>
        <div class="card-body">
            <div id="leave-extratime-echart" class="chart-donut chart-dropshadow"></div>
        </div>
        <div class="card-footer">
            <div class="mt-4" style="direction: @if (App::getLocale() == 'ar') rtl @else ltr @endif">
                <span class="ml-5">
                    <span style="background-color: #0774f8;" class="dot-label me-1"></span>
                    {{ __('global.extratime') }}
                    <span style="background-color: #09ad95;" class="dot-label me-1 ms-4"></span>
                    {{ __('global.leave') }}
                </span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ __('task.Discounts') }}
        </div>
        <div class="card-body">
            <div id="discount-echart" class="chart-donut chart-dropshadow"></div>
        </div>
        <div class="card-footer">
            <div class="mt-4" style="direction: @if (App::getLocale() == 'ar') rtl @else ltr @endif">
                <span class="ml-5">
                    <span style="background-color: #0774f8;" class="dot-label me-1"></span>
                    {{ __('global.discount') }}
                </span>
            </div>
        </div>
    </div>


</div>


@push('scripts')
    <script type="text/javascript">
        var dates = {!! json_encode($listOfDates) !!};
        // 
        var autoFinishedTask = {!! json_encode($autoFinishedTask) !!};
        var completedTask = {!! json_encode($completedTask) !!};
        var totalTask = {!! json_encode($totalTask) !!};
        // 
        var totalExtratime = {!! json_encode($totalExtratime) !!};
        var totalLeave = {!! json_encode($totalLeave) !!};

        var totalDiscount = {!! json_encode($totalDiscount) !!};

        var autoFinishedTaskSum = {{ $totalTaskSum > 0 ? round($autoFinishedTaskSum / $totalTaskSum, 2) * 100 : 0 }}
        var completedTaskSum = {{ $totalTaskSum > 0 ? round($completedTaskSum / $totalTaskSum, 2) * 100 : 0 }}
        // var totalTaskSum = {{ $totalTaskSum > 0 ? $totalTaskSum : 1 }}

        $(function() {
            refreshTaskChart();
            refreshLeaveExtratimeChart();
            refreshDiscountChart();
        });

        window.livewire.on('close-model', data => {
            dates = data[0];
            totalTask = data[1];
            completedTask = data[2];
            autoFinishedTask = data[3];

            totalExtratime = data[4];
            totalLeave = data[5];

            totalDiscount = data[6];

            autoFinishedTaskSum = data[7];
            completedTaskSum = data[8];
            // totalTaskSum = data[9];

            refreshTaskChart();
            refreshLeaveExtratimeChart();
            refreshDiscountChart();

        });

        // 
        function refreshTaskChart() {
            var chartdata = [{
                    name: "{!! __('global.total') !!}",
                    type: 'bar',
                    smooth: true,
                    data: totalTask,
                },
                {
                    name: "{!! __('global.auto') !!}",
                    type: 'bar',
                    smooth: true,
                    data: autoFinishedTask,
                },
                {
                    name: "{!! __('global.completed') !!}",
                    type: 'bar',
                    smooth: true,
                    data: completedTask,
                },
            ];
            // ['line', 'bar'];
            var chart = document.getElementById('task-echart');
            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '20',
                    right: '20',
                    bottom: '20',
                    left: '20',
                },
                xAxis: {
                    data: dates,
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

            // 

            new Morris.Donut({
                resize: false,
                element: "task-morrisBar8-don",
                data: [{
                        label: "{{ __('global.auto') }}",
                        value: autoFinishedTaskSum,
                    },
                    {
                        label: "{{ __('global.completed') }}",
                        value: completedTaskSum,
                    },
                ],
                backgroundColor: "rgba(119, 119, 142, 0.2)",
                labelColor: "#77778e",
                colors: ["#09ad95", "#d43f8d"],
                formatter: function(e) {
                    return e + '%';
                },
            }).on("click", function(e, t) {
                console.log(e, t);
            });
        }

        // 
        function refreshLeaveExtratimeChart() {
            var chartdata = [{
                    name: "{!! __('global.extratime') !!}",
                    type: 'bar',
                    smooth: true,
                    data: totalExtratime,
                },
                {
                    name: "{!! __('global.leave') !!}",
                    type: 'bar',
                    smooth: true,
                    data: totalLeave,
                },
            ];
            // ['line', 'bar'];
            var chart = document.getElementById('leave-extratime-echart');
            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '20',
                    right: '20',
                    bottom: '20',
                    left: '20',
                },
                xAxis: {
                    data: dates,
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
        }

        // 
        function refreshDiscountChart() {
            var chartdata = [{
                name: "{!! __('global.discount') !!}",
                type: 'line',
                smooth: true,
                data: totalDiscount,
            }, ];
            // ['line', 'bar'];
            var chart = document.getElementById('discount-echart');
            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '20',
                    right: '20',
                    bottom: '20',
                    left: '20',
                },
                xAxis: {
                    data: dates,
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
        }
    </script>
@endpush
