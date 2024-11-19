<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebReportController extends Controller
{
    public function indexReports()
    {
        $users = User::whereRoleIs('employee')->orderBy('first_name')->get();
        $tasks_status = Task::get();



        return view('Web.repots.reports-web', compact('users', 'tasks_status'));
    }
    public function taskCommintes(Request $request)
    {
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $tasks = Task::whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();

        return view('Web.repots.prints.task-comments-report', compact('tasks'));
    }


    public function ClosedTaskcComingSoon(Request $request)
    {

        $user = $request->input('users');

        $tasks = Task::whereBetween('created_at', [Carbon::now(), Carbon::now()->addHours(12)])->get();

        return view('Web.repots.prints.closed-reports-soon', compact('user', 'tasks'));
    }


    public function OutgoingTaskDiscounts(Request $request)
    {
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $user = $request->input('user');


        $tasks = Task::where('manager_id', $user)->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();

        return view('Web.repots.prints.outgoing-task-discounts', compact('tasks', 'user'));
    }

    public function incomingTaskDiscounts(Request $request)
    {
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $users = $request->input('users');

        $tasks = Task::whereHas('employees', function ($q) use ($users) {
            $q->where('user_id', $users);
        })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();

        return view('Web.repots.prints.incoming-task-discounts', compact('tasks'));
    }

    public function OutgoingTaskMovements()
    {
        $tasks_status = Task::get();
        return $tasks_status;
        // return  view('Web.repots.prints.outgoing-task-movements');
    }

    public function IncomingTaskMovements()
    {
        $tasks_status = Task::get();
        return $tasks_status;
        // return view('Web.repots.prints.incoming-task-movements');
    }

    public function FollowUpEmployeeTasks()
    {
        $tasks_status = Task::get();
        return $tasks_status;
        // return view('Web.repots.prints.follow-up-employee-tasks');
    }

    public function IncomingTasksNotCommentedOnToday()
    {
       
    }
}
