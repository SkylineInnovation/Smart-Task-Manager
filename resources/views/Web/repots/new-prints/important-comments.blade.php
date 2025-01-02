{{-- تعليقات مهمة --}}
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
    <table class="table table-responsive-sm"
        style="direction: rtl; width: 100%; background-color: #A8A8A8; text-align: right; margin-top: 10px;">
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
                <th colspan="4" class="col-3  align-self-center bg-white">
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
                <th scope="col" class="col-1  align-self-center">
                    <div class="col-md-12">تاريخ الاستلام </div>
                </th>
                <th scolspan="2" class="col-3  align-self-center bg-white">
                    <div class="col-md-12"> 2024/22/11</div>
                </th>
                <th scolspan="2" class="col-3  align-self-center bg-white">
                    <div class="col-md-12"> </div>
                </th>

            </tr>
            <td colspan="7" class="text-center text-white fw-bold" style="background:#a8a8a8"> ﺍﻹﻧﺠﺎﺯﺍﺕ ﻭﺍﻟﺘﻌﻠﻴﻘﺎﺕ
                ﺧﻼﻝ ﻫﺬﺓ ﺍﻟﻔﺘﺮﺓ
            </td>


            <tr>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> المرسل </div>
                </th>
                <th scope="col" class="col-2  align-self-center bg-white">
                    <div class="col-md-12">احمد</div>
                </th>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> ﺗﺎﺭﻳﺦ التعليق </div>
                </th>
                <th scope="col" class="col-2  align-self-center bg-white">
                    <div class="col-md-12">1446/06/16</div>
                </th>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> ﻭﻗﺖ ﺍﻟﺘﻌﻠﻴﻖ </div>
                </th>
                <th scope="col" class="col-1  align-self-center bg-white">
                    <div class="col-md-12">06:19 ﻡ</div>
                </th>



            </tr>
            <td colspan="7" class="text-center text-white fw-bold" style="background:#a8a8a8"> ﺑﺎﻧﺘﻈﺎﺭ ﺍﻟﺮﺩ ﻣﻦ ﻗﺒﻞ ﺍﻟﺸﺮﻛﺔ
                ﺣﻴﺚ ﺍﻧﻪ ﺗﻢ ﺍﺭﺳﺎﻝ ﻛﺎﻓﺔ ﺍﻟﺘﻔﺎﺻﻴﻞ ﻭﺍﻟﺒﻴﺎﻧﺎﺕ ﻭﻣﻮﺍﻓﺎﺗﻬﺎ ﺑﻜﺎﻓﺔ ﺍﻻﻣﻮﺭ ﺍﺛﻨﺎﺀ ﺍﻟﻤﻘﺎﺑﻠﺔ ﻭﺑﺎﻟﺘﻮﺍﺻﻞ ﻉ ﺍﻟﻬﺎﺗﻒ ﺍﻻﺭﺿﻲ ﻟﻠﻌﻤﻞ

            </td>

            <tr>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> المرسل </div>
                </th>
                <th scope="col" class="col-2  align-self-center bg-white">
                    <div class="col-md-12">احمد</div>
                </th>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> ﺗﺎﺭﻳﺦ التعليق </div>
                </th>
                <th scope="col" class="col-2  align-self-center bg-white">
                    <div class="col-md-12">1446/06/16</div>
                </th>
                <th scope="col" class="col-1  align-self-center" style="background-color:#EFF8FF ">
                    <div class="col-md-12"> ﻭﻗﺖ ﺍﻟﺘﻌﻠﻴﻖ </div>
                </th>
                <th scope="col" class="col-1  align-self-center bg-white">
                    <div class="col-md-12">06:19 ﻡ</div>
                </th>



            </tr>
            <td colspan="7" class="text-center text-white fw-bold" style="background:#a8a8a8"> ﺑﺎﻧﺘﻈﺎﺭ ﺍﻟﺮﺩ ﻣﻦ ﻗﺒﻞ ﺍﻟﺸﺮﻛﺔ ﺣﻴﺚ ﺍﻧﻪ ﺗﻢ ﺍﺭﺳﺎﻝ ﻛﺎﻓﺔ ﺍﻟﺘﻔﺎﺻﻴﻞ ﻭﺍﻟﺒﻴﺎﻧﺎﺕ ﻭﻣﻮﺍﻓﺎﺗﻬﺎ ﺑﻜﺎﻓﺔ ﺍﻻﻣﻮﺭ ﺍﺛﻨﺎﺀ ﺍﻟﻤﻘﺎﺑﻠﺔ ﻭﺑﺎﻟﺘﻮﺍﺻﻞ ﻉ ﺍﻟﻬﺎﺗﻒ ﺍﻻﺭﺿﻲ ﻟﻠﻌﻤﻞ

            </td>


        </thead>
    </table>
@endsection
