@extends('layouts.livewire-app-print')

@section('css')
    <style>
        * {
            border-spacing: 0px !important;
        }

        td {
            border: solid 1px;
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
    </style>
@endsection

@section('content')
    <button class="btn btn-primary mx-1 hidden-print" onclick="window.print();">
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
        {{ __('global.Print') }}
    </button>

    <table style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
        <tbody>

            @foreach ($income_tasks_almost_soon as $task)
                <tr>
                    <td class="sub-colored">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</td>
                    <td class="">{{ $task->id }}</td>
                    <td class="sub-colored">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</td>
                    <td class="" colspan="7">{{ $task->name }}</td>
                </tr>
                <tr>
                    <td class="sub-colored">ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ</td>
                    <td>{{ $task->manager->name() }}</td>
                    <td class="sub-colored">الموظفين</td>
                    <td colspan="5">{{ $task->employees ? $task->employee_names_export() : '' }}</td>

                    <td class="sub-colored">تاريخ الاستلام</td>
                    <td>{{ date('d/m/Y', strtotime($task->created_at)) }}</td>
                </tr>

                <tr class="title-colord">
                    <td colspan="10" style="text-align: center">
                        ﺍﻹﻧﺠﺎﺯﺍﺕ ﻭﺍﻟﺘﻌﻠﻴﻘﺎﺕ ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ
                    </td>
                </tr>

                @foreach ($task->comments as $comment)
                    <tr>
                        <td class="sub-colored">المرسل</td>
                        <td>{{ $comment->user->name() }}</td>
                        <td class="sub-colored">تاريخ التعليق</td>
                        <td>{{ date('d/m/Y', strtotime($comment->created_at)) }}</td>
                        <td class="sub-colored">ﻭﻗﺖ ﺍﻟﺘﻌﻠﻴﻖ</td>
                        <td>{{ date('h:i A', strtotime($comment->created_at)) }}</td>
                        <td style="border-bottom: 0px;" class="body-colored" colspan="4"></td>
                    </tr>
                    <tr>
                        <td style="border-top: 0px; padding: 10px;" class="body-colored" colspan="10">
                            {{ $comment->desc }}
                        </td>
                    </tr>
                @endforeach
            @endforeach

        </tbody>
    </table>
@endsection
