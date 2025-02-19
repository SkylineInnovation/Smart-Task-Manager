{{-- متابعة مهام الموظفين --}}

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

    @php
        $task_with_comment_count = 0;
        $task_without_comment_count = 0;
        $total_discounts = 0;
        $task_auto_finished = 0;
    @endphp

    <div class="col-md-12 d-flex justify-content-center">

        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">

            @foreach ($tasks as $task)
                @php
                    if ($task->comments->count() > 0) {
                        $task_with_comment_count++;
                    } else {
                        $task_without_comment_count++;
                    }

                    $total_discounts = $task->discounts->sum('amount');

                    if ($task->status == 'auto-finished') {
                        $task_auto_finished++;
                    }

                @endphp

                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #FF9896">
                        <div class="col-md-12">ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #FF9896">
                        <div class="col-md-12">{{ $task->manager->name() }}</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺍﻹﻧﺸﺎﺀ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">{{ $task->format_date($task->created_at) }}</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺁﺧﺮ ﺣﺮﻛﺔ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">{{ $task->format_date($task->updated_at) }}</div>
                    </th>

                </tr>

                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12">اجمالي الحركات </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12">{{ $task->comments->count() }}</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺍﻹﻏﻼﻕ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">{{ $task->format_date($task->end_time) }}</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12"> حالة الحركة </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12">{{ __('task.' . $task->status) }}</div>
                    </th>

                </tr>

                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12">{{ $task->id }}</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ </div>
                    </th>
                    <th colspan="3" class="col-1  align-self-center">
                        <div class="col-md-12">{{ $task->title }}</div>
                    </th>
                </tr>

                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12">ﺍﻟﻮﻗﺖ</div>
                    </th>
                    <th colspan="5" class="  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12 text-center">ﺗﻌﻠﻴﻖ ﺍﻟﻤﻮﻇﻒ</div>
                    </th>

                </tr>

                @forelse ($task->comments as $comment)
                    <tr>
                        <th scope="col" class="col-1  align-self-center" style="background-color: #ffffff">
                            <div class="col-md-12">{{ $task->format_date($comment->created_at) }}</div>
                        </th>
                        <th colspan="5" class="  align-self-center" style="background-color: #ffffff">
                            {{-- {{ $comment->title }} <br> --}}
                            {{ $comment->desc }}
                        </th>
                    </tr>
                @empty
                    <tr>
                        <th scope="col" class="col-1  align-self-center" style="background-color: #ffffff">
                            <div class="col-md-12">-- -- --</div>
                        </th>
                        <th colspan="5" class="  align-self-center" style="background-color: #ffffff">
                            ﻻ ﺗﻮﺟﺪ ﺣﺮﻛﺎﺕ ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ
                        </th>
                    </tr>
                @endforelse
            @endforeach

        </table>
    </div>

    <div class="container-fluid bg-white pt-4" style="direction: rtl;">
        <div class="row w-100 m-0">
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻔﻌﺎﻟﺔ ﺍﻟﻤﻌﻠﻖ</div>
            <div class="col border-1">{{ $task_with_comment_count }}</div>
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻔﻌﺎﻟﺔ ﺍﻟﻐﻴﺮ ﻣﻌﻠﻖ ﻋﻠﻴﻬﺎ</div>
            <div class="col border-1">{{ $task_without_comment_count }}</div>
            <div class="col border-1"> ﺍﺟﻤﺎﻟﻲ ﺍﻟﺨﺼﻮﻣﺎﺕ</div>
            <div class="col border-1">{{ $total_discounts }}</div>
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻤﻐﻠﻘﺔ ﺗﻠﻘﺎﺋﻲ</div>
            <div class="col border-1">{{ $task_auto_finished }}</div>
        </div>
    </div>
@endsection
