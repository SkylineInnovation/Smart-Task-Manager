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
    </style>
@endsection

@section('content')
    <button class="btn btn-primary mx-1 hidden-print" onclick="window.print();">
        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
        {{ __('global.Print') }}
    </button>

    <div class="container d-flex justify-content-center">
        <table class="table table-responsive"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
            <tbody class="">

                <thead>
                    <tr>
                        <th class="col-2" scope="col">رقم المهمة عنوان المهمة</th>
                        <th class="col-2" scope="col">جهة التكليف</th>
                        <th class="col-2" scope="col">تاريخ الاغلاق</th>
                        <th class="col-2" scope="col">الحالة</th>
                        <th class="col-2 text-center" scope="col">اجمالي الخصومات الالكترونية</th>
                        <th class="col-2" scope="col">اجمالي الخصومات اليدوية</th>
                        <th class="col-1" scope="col">التقيم</th>
                    </tr>

                </thead>

                @foreach ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $task->id }} {{$task->title}}</th>
                        <td>{{ $task->employees ? $task->employee_names_export() : '' }}</td>

                        <td>
                            {{ date('d/m/Y', strtotime($task->end_time)) }}

                        </td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->discounts->where('user_id', $user)->sum('amount') }}</td>
                        <td>{{ $task->discounts->where('user_id', $user)->whereNotIn('reason', ['auto-finished', 'manual-finished'])->sum('amount') }}
                        </td>

                        <td>
                            none
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{-- @foreach ($tasks as $task)
            <tr>
                <td class="sub-colored">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</td>
                <td class="">{{ $task->id }}</td>
                <td class="sub-colored">ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ</td>
                <td class="" colspan="7">{{ $task->title }}</td>
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

            @foreach ($task->discounts->where('user_id', $user) as $discount)
                <tr>
                    <td class="sub-colored">المرسل</td>
                    <td>{{ $discount->amount }}</td>
                    <td class="sub-colored">تاريخ التعليق</td>
                    <td>{{ date('d/m/Y', strtotime($discount->created_at)) }}</td>
                    <td class="sub-colored">ﻭﻗﺖ ﺍﻟﺘﻌﻠﻴﻖ</td>
                    <td>{{ date('h:i A', strtotime($discount->created_at)) }}</td>
                    <td style="border-bottom: 0px;" class="body-colored" colspan="4"></td>
                </tr>
                <tr>
                    <td style="border-top: 0px; padding: 10px;" class="body-colored" colspan="10">
                        {{ $discount->reason }}
                    </td>
                </tr>
            @endforeach
        @endforeach --}}

            </tbody>
        </table>
    </div>
@endsection
