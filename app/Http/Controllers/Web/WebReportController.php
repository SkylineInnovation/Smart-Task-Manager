<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class WebReportController extends Controller
{
    public function indexReports()
    {
        return view('Web.repots.reports-web');
    }
    public function taskCommintes(Request $request)
    {
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $tasks = Task::whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();
       
        return view('Web.repots.prints.task-comments-report',compact('tasks'));
    }
}
