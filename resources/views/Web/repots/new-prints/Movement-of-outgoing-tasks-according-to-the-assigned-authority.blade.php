{{-- حركة المهام الصادرة حسب الجهة المكلفة --}}

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
    <table class="table table-responsive-sm border-0"
        style="direction: rtl; width: 100%; background-color: #A8A8A8; text-align: right; margin-top: 10px;">
        <thead>
            <tr style="background-color: #EFF8FF">
                <th scope="col" class="col-2  align-self-center">
                    <div class="col-md-12">ﺍﻟﻤﺮﺳﻞ </div>
                </th>
                <th colspan="" class="col-8  align-self-center bg-white">
                    <div class="col-md-12"> </div>
                </th>
                <th colspan="2" class="  align-self-center ">
                    <div class="col-md-12">ﺗﺎﺭﻳﺦ ﺍﻟﺤﺮﻛﺔ </div>
                </th>

            </tr>
        </thead>

        <thead>
            <tr style="background-color: #EFF8FF">
                <th scope="col" class="col-1  align-self-center bg-success text-white">
                    <div class="col-md-12 "> ﺍﻻﺳﺘﺎﺫ / ﺍﺑﺮﺍﻫﻴﻢ ﺍﻟﻌﺒﺮﺓ</div>
                </th>
                <th colspan="" class="col-8  align-self-center text-white" style="background-color: #a8a8a8">
                    <div class="col-md-12">] 13049 [ ﺍﻟﻤﻬﺎﻡ ﺑﺎﻟﻔﺘﺮﺓ ﺍﻟﻤﺴﺎﺋﻴﺔ ) ﺗﺪﺭﻳﺐ - ﺗﺴﻮﻳﻖ ( </div>
                </th>
                <th colspan="2" class="  align-self-center " style="background-color: #FF9896">
                    <div class="col-md-12"> 1446/06/18 05:33 ﻡ </div>
                </th>

            </tr>
            <tr>
                <th colspan="3" class="  align-self-center " style="background-color: #ffffff">
                    <div class="col-md-12"> ...... ﺗﻢ ﺍﺩﺧﺎﻝ ﺍﻟﻤﺎﻟﻴﻪ ﺗﺎﺭﻳﺦ 12/19 ﺭﻓﻌﻬﺎ ﻓﻲ ﺍﻟﺴﺴﺘﻢ ] 59 </div>
                </th>
            </tr>
        </thead>
        <thead>
            <tr style="background-color: #EFF8FF">
                <th scope="col" class="col-1  align-self-center bg-success text-white">
                    <div class="col-md-12 "> ﺍﻻﺳﺘﺎﺫ / ﺍﺑﺮﺍﻫﻴﻢ ﺍﻟﻌﺒﺮﺓ</div>
                </th>
                <th colspan="" class="col-8  align-self-center text-white" style="background-color: #a8a8a8">
                    <div class="col-md-12">] 13049 [ ﺍﻟﻤﻬﺎﻡ ﺑﺎﻟﻔﺘﺮﺓ ﺍﻟﻤﺴﺎﺋﻴﺔ ) ﺗﺪﺭﻳﺐ - ﺗﺴﻮﻳﻖ ( </div>
                </th>
                <th colspan="2" class="  align-self-center " style="background-color: #FF9896">
                    <div class="col-md-12"> 1446/06/18 05:33 ﻡ </div>
                </th>

            </tr>
            <tr>
                <th colspan="3" class="  align-self-center " style="background-color: #ffffff">
                    <div class="col-md-12"> ﺗﻢ ﺍﺻﺪﺍﺭ ﺍﻟﺠﺪﺍﻭﻝ ﻟﻠﻤﺴﺘﺠﺪﻳﻦ ﻭ ﺗﻮﻗﻴﻊ ﺍﻟﻌﻘﻮﺩ ﻭ ﺍﻟﺒﺪ ﻓﻲ ﺍﻟﻤﻨﺎﻫﺞ ] 60 [ </div>
                </th>
            </tr>
        </thead>
    </table>
@endsection
