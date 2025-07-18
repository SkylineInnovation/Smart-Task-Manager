{{-- تعليقات المهام المحددة --}}

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

    @foreach ($viewTasks as $task)
        <div style="min-height: 300px">
            <table class="table table-responsive-sm"
                style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #EFF8FF">
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->id ?? '' }}</div>
                        </th>
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->title ?? '' }} </div>
                        </th>

                    </tr>
                </thead>
                <thead>
                    <tr style="background-color: #EFF8FF">
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12"> ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ</div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->manager->first_name ?? '' }}</div>
                        </th>
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">الموظفين </div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">
                                @foreach ($task->employees as $taskEmp)
                                    {{ $taskEmp->first_name ?? '' }},
                                @endforeach
                            </div>
                        </th>
                        <th scope="col" class="col-1  align-self-center">
                            <div class="col-md-12">تاريخ الاستلام </div>
                        </th>
                        <th scope="col" class="col-2  align-self-center bg-white">
                            <div class="col-md-12">{{ $task->created_at->format('Y-m-d') ?? '' }} </div>
                        </th>

                    </tr>
                    @foreach ($task->comments as $tsComm)
                        <tr>
                            <td colspan="6" class="text-center text-white fw-bold" style="background:#a8a8a8">
                                {{ $tsComm->desc ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    @endforeach
@endsection
