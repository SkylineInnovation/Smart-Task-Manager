@extends('layouts.livewire-app')


@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <h2 class="card-title">hi al in dashboard page</h2>
        </div> --}}
        <div class="card-body">
            <div id="home-echart" class="chart-donut chart-dropshadow"></div>
        </div>
        <div class="card-footer">
            <div class="mt-4" style="direction: @if (App::getLocale() == 'ar') rtl @else ltr @endif">
                <span class="ml-5">
                    <span class="dot-label bg-info mr-2"></span> {{ __('global.users') }}
                </span>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
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
    </script>
@endsection
