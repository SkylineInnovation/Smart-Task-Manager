<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebReportController extends Controller
{
    public function indexReports()
    {
        return view('Web.repots.reports-web');
    }
}
