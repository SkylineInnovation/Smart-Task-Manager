{{-- تعليقات كل المهام --}}


@extends('layouts.livewire-app-print')

@section('css')
    <style>
        * {
            border-spacing: 0px !important;
        }

        th {
            border: solid 0.5px;

            margin: 0px;
        }

        td {
            border: solid 0.5px;
            padding: 5px;
            margin: 0px;
        }

        .title-colord {
            background-color: #BABABA;
        }

        .sub-colored {
            background-color: #F1F8FD;
        }

        .body-colored {
            background-color: #E8E8E8;
        }

        .table thead th {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')
    <button class="btn btn-primary mx-1 hidden-print" onclick="window.print();">
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
        {{ __('global.Print') }}
    </button>

    @foreach ($tasks as $task)
        <div class="col-md-12 d-flex justify-content-center">
            <table class="table table-responsive-sm"
                style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #EFF8FF">
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->id }}</div>
                        </th>
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12"> {{ $task->title }}</div>
                        </th>

                    </tr>
                </thead>
                <thead>
                    <tr style="background-color: #EFF8FF">
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12"> ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->manager->name() }}</div>
                        </th>
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">الموظفين </div>
                        </th>

                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">
                                [
                                @foreach ($task->employees as $taskEmp)
                                    {{ $taskEmp->name() }} ,
                                @endforeach
                                ]
                            </div>
                        </th>


                    </tr>
                    @foreach ($task->comments as $taskCommints)
                        <td colspan="4" class="text-start text-white fw-bold" style="background:#a8a8a8">
                            {{ $taskCommints->user->name() . ' : ' }}
                            <br>
                            {{ $taskCommints->title }}

                            {{ $taskCommints->desc }}
                        </td>
                    @endforeach
                </thead>
            </table>
        </div>
    @endforeach

    {{-- <div class="col-md-12 d-flex justify-content-center">
        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">13442</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">ﺷﺮﻛﺔ ﺑﺎﻃﻮﻕ ﺍﻟﺘﺠﺎﺭﻳﺔ</div>
                    </th>

                </tr>
            </thead>
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">ﻭﺳﺎﻡ ﺍﺑﻮ ﺧﻀﺮ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">الموظفين </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> [احمد ، محمد ، حسن ، جواد]</div>
                    </th>

                </tr>
                <td colspan="4" class="text-center text-white fw-bold" style="background:#a8a8a8"> ﺍﻹﻧﺠﺎﺯﺍﺕ ﻭﺍﻟﺘﻌﻠﻴﻘﺎﺕ
                    ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ
                </td>
            </thead>
        </table>
    </div>

    <div class="col-md-12 d-flex justify-content-center">
        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">13442</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">ﺷﺮﻛﺔ ﺑﺎﻃﻮﻕ ﺍﻟﺘﺠﺎﺭﻳﺔ</div>
                    </th>

                </tr>
            </thead>
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ</div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">ﻭﺳﺎﻡ ﺍﺑﻮ ﺧﻀﺮ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">الموظفين </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> [احمد ، محمد ، حسن ، جواد]</div>
                    </th>

                </tr>
                <td colspan="4" class="text-center text-white fw-bold" style="background:#a8a8a8"> ﺍﻹﻧﺠﺎﺯﺍﺕ ﻭﺍﻟﺘﻌﻠﻴﻘﺎﺕ
                    ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ
                </td>
            </thead>
        </table>
    </div> --}}
@endsection
