<div class="modal fade" id="exampleModalCenter{{ $loop }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header  bg-dark text-light">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{ __('global.Mission Details No') }}.{{ $taskID }}</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dirv class="row w-100 m-0 ">

                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside1"
                            class=" d-flex justify-content-center w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/comment.png') }}" width="24px"
                                height="24px" alt="" srcset="">

                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside2"
                            class=" d-flex justify-content-center  w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/close-request.png') }}"
                                width="24" height="24px" alt="" srcset="">

                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside3"
                            class=" d-flex justify-content-center w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/extend-request.png') }}"
                                width="24px" height="24px" alt="" srcset="">

                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside4"
                            class=" d-flex justify-content-center w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/progress.png') }}" width="24px"
                                height="24px" alt="" srcset="">

                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside5"
                            class=" d-flex justify-content-center w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/warn.png') }}" width="24px"
                                height="24px" alt="" srcset="">

                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="" data-toggle="modal" data-target="#exampleModalCenterInside6"
                            class=" d-flex justify-content-center w-100 ">
                            <img class="iconsIffict" src="{{ asset('assets/dashboard/deduction.png') }}" width="24px"
                                height="24px" alt="" srcset="">

                        </a>
                    </div>
                </dirv>

                <hr>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3  border-bottom d-flex justify-content-center active"
                            id="pills-infoTask-tab" data-toggle="pill" href="#pills-infoTask" role="tab"
                            aria-controls="pills-infoTask" aria-selected="true">Info Task</a>
                    </li>
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3   border-bottom d-flex justify-content-center"
                            id="pills-Employee-tab" data-toggle="pill" href="#pills-Employee" role="tab"
                            aria-controls="pills-Employee" aria-selected="false">Employee</a>
                    </li>
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3   border-bottom d-flex justify-content-center"
                            id="pills-CloseRequest-tab" data-toggle="pill" href="#pills-CloseRequest" role="tab"
                            aria-controls="pills-CloseRequest" aria-selected="false">Close Request</a>
                    </li>
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3   border-bottom d-flex justify-content-center"
                            id="pills-Warnings-tab" data-toggle="pill" href="#pills-Warnings" role="tab"
                            aria-controls="pills-Warnings" aria-selected="false">Warnings</a>
                    </li>
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3   border-bottom d-flex justify-content-center"
                            id="pills-Discount-tab" data-toggle="pill" href="#pills-Discount" role="tab"
                            aria-controls="pills-Discount" aria-selected="false">Discount</a>
                    </li>
                    <li class="nav-item col-4 px-0 m-0  ">
                        <a class="nav-link w-100 py-3   border-bottom d-flex justify-content-center"
                            id="pills-Comments-tab" data-toggle="pill" href="#pills-Comments" role="tab"
                            aria-controls="pills-Comments" aria-selected="false">Comments</a>
                    </li>

                </ul>

                <div class="tab-content" id="pills-tabContent">

                    {{-- table tab --}}
                    <div class="tab-pane fade show active" id="pills-infoTask" role="tabpanel"
                        aria-labelledby="pills-infoTask-tab">

                        <table class="table table-bordered ">

                            <tbody>

                                <tr>
                                    <td>
                                        {{ __('global.Task Details') }}
                                    </td>

                                    <td>{{ $value->title }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Comment Grace Period') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Maximum Warnings') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Discount Amount When Reaching Maximum Warnings') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Discount Amount When Reaching Maximum Warnings') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Discount Amount When Reaching Maximum Warnings') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Discount Amount When Reaching Maximum Warnings') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Delivery Date') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Assignee') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ __('global.Employees') }}
                                    </td>

                                    <td>{{ $value->id }}</td>
                                </tr>



                            </tbody>
                        </table>



                    </div>


                    <div class="tab-pane fade" id="pills-Employee" role="tabpanel"
                        aria-labelledby="pills-Employee-tab">

                        <div class="container">
                            <div class="row w-100 m-0 ">

                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside1"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/comment.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside2"
                                        class=" d-flex justify-content-center  w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/close-request.png') }}" width="24"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside3"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/extend-request.png') }}" width="24px"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside4"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/progress.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside5"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/warn.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside6"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/deduction.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                            </div>

                            <table class="table table-bordered  mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>


                    </div>
                    <div class="tab-pane fade" id="pills-CloseRequest" role="tabpanel"
                        aria-labelledby="pills-CloseRequest-tab">


                        <div class="container">
                            <div class="row w-100 m-0 ">

                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside1"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/comment.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside2"
                                        class=" d-flex justify-content-center  w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/close-request.png') }}" width="24"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside3"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/extend-request.png') }}" width="24px"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside4"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/progress.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside5"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/warn.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside6"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/deduction.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                            </div>

                            <table class="table table-bordered  mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>


                    </div>
                    <div class="tab-pane fade" id="pills-Warnings" role="tabpanel"
                        aria-labelledby="pills-Warnings-tab">


                        <div class="container">
                            <div class="row w-100 m-0 ">

                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside1"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/comment.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside2"
                                        class=" d-flex justify-content-center  w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/close-request.png') }}" width="24"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside3"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/extend-request.png') }}" width="24px"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside4"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/progress.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside5"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/warn.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside6"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/deduction.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                            </div>

                            <table class="table table-bordered  mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>


                    </div>
                    <div class="tab-pane fade" id="pills-Discount" role="tabpanel"
                        aria-labelledby="pills-Discount-tab">


                        <div class="container">
                            <div class="row w-100 m-0 ">

                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside1"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/comment.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside2"
                                        class=" d-flex justify-content-center  w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/close-request.png') }}" width="24"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside3"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict"
                                            src="{{ asset('assets/dashboard/extend-request.png') }}" width="24px"
                                            height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside4"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/progress.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside5"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/warn.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#exampleModalCenterInside6"
                                        class=" d-flex justify-content-center w-100 ">
                                        <img class="iconsIffict" src="{{ asset('assets/dashboard/deduction.png') }}"
                                            width="24px" height="24px" alt="" srcset="">

                                    </a>
                                </div>
                            </div>

                            <table class="table table-bordered  mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-Comments" role="tabpanel"
                        aria-labelledby="pills-Comments-tab">
                    
                    
                    
                        <div class="container">
                            

                            <table class="table table-bordered  mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


@for ($i = 1; $i < 7; $i++)
    @include('Web.task.modal-task-inside-modal', ['i' => $i])
@endfor
