{{-- الخصومات المهام الصادرة --}}

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
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-6  align-self-center">
                        <div class="col-md-12">[رقم المهمة] عنوان المهمة</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺗﺎﺭﻳﺦ ﺍﻹﻏﻼﻕ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺣﺎﻟﺔ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺇﺟﻤﺎﻟﻲ ﺍﻟﺨﺼﻮﻣﺎﺕ ﺍﻹﻟﻜﺘﺮﻭﻧﻴﺔ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺇﺟﻤﺎﻟﻲ ﺍﻟﺨﺼﻮﻣﺎﺕ ﺍﻟﻴﺪﻭﻳﺔ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺍﻟﺘﻘﻴﻴﻢ </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center text-white fw-bold" style="background:#19AC47">ﺍﺳﺘﺎﺫ / ﺍﺣﻤﺪ ﺣﻜﻴﻢ
                    </td>

                </tr>
                <tr>
                    <th scope="row">]12995[ ﺭﺧﺺ ﺍﻟﺒﻠﺪﻳﺔ ﻭﺍﻟﺪﻓﺎﻉ ﺍﻟﻤﺪﻧﻲ ﻟﻜﻞ ﻓﺮﻉ</th>
                    <td>1446/09/15 <br> 04:55 ﻡ</td>
                    <td>ﺗﺤﺖ ﺍﻟﺘﻨﻔﻴﺬ</td>
                    <td>SAR 50</td>
                    <td>SAR 0</td>
                    <td> ﻏﻴﺮ ﻣﺤﺪﺩ</td>
                </tr>

                <tr>
                    <td colspan="1" class="text-center text-white fw-bold" style="background:#FF9896">ﻋﺪﺩ ﺍلمهام /٤
                    </td>

                    <td colspan="2" class="text-center text-white fw-bold" style="background:#a8a8a8"></td>
                    <td colspan="1" class="text-center text-white fw-bold" style="background:#FF9896">SAR 50</td>
                    <td colspan="1" class="text-center text-white fw-bold" style="background:#FF9896">SAR 0</td>
                    <td colspan="1" class="text-center text-white fw-bold" style="background:#a8a8a8"></td>

                </tr>

            </tbody>
        </table>
    </div>
@endsection
