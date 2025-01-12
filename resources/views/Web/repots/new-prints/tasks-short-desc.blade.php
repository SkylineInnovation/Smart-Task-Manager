{{-- سجل مختصر للمهام --}}
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

    <div class="">
        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="">
                        ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ
                    </th>
                    <th scope="col" class="">
                        ﺍﻟﻌﻨﻮﺍﻥ
                    </th>
                    <th scope="col" class="">
                        ﺗﺎﺭﻳﺦ ﺍﻹﻧﺸﺎﺀ
                    </th>
                    <th scope="col" class="">
                        ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ
                    </th>
                    <th scope="col" class="">
                        ﺍﻟﻤﻮﻇﻔﻮﻥ
                    </th>
                    <th scope="col" class="">
                        ﺗﺎﺭﻳﺦ ﺍﻟﺘﺴﻠﻴﻢ
                    </th>
                    <th scope="col" class="">
                        ﺍﻟﺤﺎﻟﺔ
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th>{{ $task->id }}</th>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->manager->name() }}</td>
                        <td>{!! $task->employee_names() !!}</td>
                        <td>{{ $task->start_time }}</td>
                        <td>{{ __('task.' . $task->status) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
