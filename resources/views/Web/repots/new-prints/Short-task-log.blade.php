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

    <div class="col-md-12 d-flex justify-content-center ">
        <table class="table table-responsive-sm"
            style="direction: rtl; width: 100%; background-color: #ffffff; text-align: right; margin-top: 10px;">
            <thead>
                <tr style="background-color: #EFF8FF">
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺭﻗﻢ ﺍﻟﻤﻬﻤﺔ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺍﻟﻌﻨﻮﺍﻥ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺗﺎﺭﻳﺦ ﺍﻹﻧﺸﺎﺀ</div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺟﻬﺔ
                            ﺍﻟﺘﻜﻠﻴﻒ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12">ﺍﻟﻤﻮﻇﻔﻮﻥ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺗﺎﺭﻳﺦ
                            ﺍﻟﺘﺴﻠﻴﻢ </div>
                    </th>
                    <th scope="col" class="col-1  align-self-center">
                        <div class="col-md-12"> ﺍﻟﺤﺎﻟﺔ
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">13442</th>
                    <td>ﺷﺮﻛﺔ ﺑﺎﻃﻮﻕ ﺍﻟﺘﺠﺎﺭﻳﺔ</td>
                    <td>1446/06/02 </td>
                    <td>ﻭﺳﺎﻡ ﺍﺑﻮ ﺧﻀﺮ</td>
                    <td>SAR 0</td>
                    <td>  1446/06/23</td>
                    <td> ﺳﺎﺭﻳﺔ </td>
                </tr>
            </tbody>

        </table>
    </div>
@endsection
