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

    <div class="col-md-12 d-flex justify-content-center">
        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">


            <thead>
                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #FF9896">
                        <div class="col-md-12">ﺟﻬﺔ ﺍﻟﺘﻜﻠﻴﻒ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #FF9896">
                        <div class="col-md-12"> ﺍﻟﻤﻬﻨﺪﺱ / ﻭﺳﺎﻡ ﺍﺑﻮ ﺧﻀﺮ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺍﻹﻧﺸﺎﺀ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> 1446/06/15 06:11 ﻡ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺁﺧﺮ ﺣﺮﻛﺔ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> 1446/06/14 07:32 ﻡ</div>
                    </th>

                </tr>
            </thead>
            <thead>
                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12">اجمالي الحركات </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12"> 6</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ ﺍﻹﻏﻼﻕ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> 1446/06/15 06:11 ﻡ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #8F861C">
                        <div class="col-md-12"> حالة الحركة </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center bg-white">
                        <div class="col-md-12"> تحت التنفيذ</div>
                    </th>

                </tr>
            </thead>

            <thead>
                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ </div>
                    </th>
                    <th scope="col" class="col-2  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12"> 13517</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12"> ﻋﻨﻮﺍﻥ ﺍﻟﻤﻬﻤﺔ </div>
                    </th>
                    <th colspan="3" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺯﻳﺎﺭﺓ ﻓﺮﻉ ﻭﺯﺍﺭﺓ ﺍﻟﺮﻳﺎﺿﺔ </div>
                    </th>


                </tr>

                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12">ﺍﻟﻮﻗﺖ </div>
                    </th>
                    <th colspan="5" class="  align-self-center" style="background-color: #EFF8FF">
                        <div class="col-md-12 text-center"> ﺗﻌﻠﻴﻖ ﺍﻟﻤﻮﻇﻒ 13517</div>
                    </th>

                </tr>
                <tr>
                    <th scope="col" class="col-1  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12">--- </div>
                    </th>
                    <th colspan="5" class="  align-self-center" style="background-color: #ffffff">
                        <div class="col-md-12"> ﻻ ﺗﻮﺟﺪ ﺣﺮﻛﺎﺕ ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ</div>
                    </th>

                </tr>
            </thead>

        </table>
    </div>

    <div class="container-fluid bg-white pt-4">
        <div class="row w-100 m-0">
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻔﻌﺎﻟﺔ ﺍﻟﻤﻌﻠﻖ</div>
            <div class="col border-1">9</div>
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻔﻌﺎﻟﺔ ﺍﻟﻐﻴﺮ ﻣﻌﻠﻖ ﻋﻠﻴﻬﺎ</div>
            <div class="col border-1"> 20</div>
            <div class="col border-1"> ﺍﺟﻤﺎﻟﻲ ﺍﻟﺨﺼﻮﻣﺎﺕ</div>
            <div class="col border-1"> 50.0</div>
            <div class="col border-1">ﻋﺪﺩ ﺍﻟﻤﻬﺎﻡ ﺍﻟﻤﻐﻠﻘﺔ ﺗﻠﻘﺎﺋﻲ</div>
            <div class="col border-1">0</div>
        </div>
    </div>
@endsection
