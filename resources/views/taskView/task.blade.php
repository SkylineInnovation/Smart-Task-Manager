@extends('layouts.livewire-app')


@section('content')
    <style>
        div {
            /* border: solid black 1px */
        }

        .fileupload {


            position: relative;
            overflow: hidden;



            /* and other things to make it pretty */
        }

        .fileupload input {
            position: absolute;
            top: 0;
            right: 0;
            /* not left, because only the right part of the input seems to
                             be clickable in some browser I can't remember */
            cursor: pointer;
            opacity: 0.0;
            filter: alpha(opacity=0);
            /* and all the other old opacity stuff you
                                             want to support */
            font-size: 300px;
            /* wtf, but apparently the most reliable way to make
                                     a large part of the input clickable in most browsers */
            height: 200px;
        }
    </style>
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
                                                data-toggle="modal" data-target="#exampleModal">

                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">

                                                                <div class="col-12">
                                                                    <strong>Discription :</strong>
                                                                    <br>

                                                                    <small class="fs-6 text-gray">Postim Beka travel</small>
                                                                </div>





                                                            </div>


                                                            <div class="col-md-12 pt-5">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item px-3 ">
                                                                        <a class="nav-link py-3 rounded-pill active"
                                                                            id="user-tab" data-toggle="tab" href="#user"
                                                                            role="tab" aria-controls="user"
                                                                            aria-selected="true">user</a>
                                                                    </li>
                                                                    <li class="nav-item px-3 ">
                                                                        <a class="nav-link py-3 rounded-pill"
                                                                            id="attatchment-tab" data-toggle="tab"
                                                                            href="#attatchment" role="tab"
                                                                            aria-controls="attatchment"
                                                                            aria-selected="false">attatchment</a>
                                                                    </li>
                                                                    <li class="nav-item px-3 ">
                                                                        <a class="nav-link py-3 rounded-pill"
                                                                            id="comment-tab" data-toggle="tab"
                                                                            href="#comment" role="tab"
                                                                            aria-controls="comment"
                                                                            aria-selected="false">comment</a>
                                                                    </li>

                                                                    <li class="nav-item px-3 ">
                                                                        <a class="nav-link py-3 rounded-pill"
                                                                            id="subTask-tab" data-toggle="tab"
                                                                            href="#subTask" role="tab"
                                                                            aria-controls="subTask"
                                                                            aria-selected="false">subTask</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade show active" id="user"
                                                                        role="tabpanel" aria-labelledby="user-tab">

                                                                        <div class="col-md-12 table-responsive">
                                                                            <table class="table  ">
                                                                                <thead>
                                                                                    <tr>

                                                                                        <th scope="col-8">user</th>
                                                                                        <th scope="col">Role</th>
                                                                                        <th scope="col">Assigned</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="fs-6">
                                                                                    <tr>

                                                                                        <td>
                                                                                            <div class="row w-100 m-0 ">
                                                                                                <div
                                                                                                    class="col-md-3 align-content-center">
                                                                                                    <img src="{{ asset('assets/images/users/12.jpg') }}"
                                                                                                        style="border-radius: 40%; width: 50px;"
                                                                                                        alt="">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-9 align-content-center">
                                                                                                    <div class="col-12">
                                                                                                        name
                                                                                                    </div>
                                                                                                    <div class="col-12">
                                                                                                        <small>
                                                                                                            example@example.com
                                                                                                        </small>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="align-content-center">
                                                                                            Otto</td>
                                                                                        <td class="align-content-center">
                                                                                            @mdo</td>
                                                                                    </tr>


                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>


                                                                    <div class="tab-pane fade" id="attatchment"
                                                                        role="tabpanel" aria-labelledby="attatchment-tab">

                                                                        <div class="fileupload btn btn-success">

                                                                            <input type="file" placeholder="" />

                                                                            uploade image
                                                                        </div>
                                                                    </div>



                                                                    <div class="tab-pane fade" id="comment"
                                                                        role="tabpanel" aria-labelledby="comment-tab">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlTextarea1">create
                                                                                comments</label>
                                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-end">
                                                                            <button type="submit" class="btn btn-success">post</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane fade" id="subTask"
                                                                        role="tabpanel" aria-labelledby="subTask-tab">...
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
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
                                            <select class="form-select bg-red-lighter"
                                                aria-label="Default select example">
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
                                            <select class="form-select bg-gray-lighter"
                                                aria-label="Default select example">
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
