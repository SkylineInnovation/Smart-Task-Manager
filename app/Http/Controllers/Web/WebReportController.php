<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\LogHistory;
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

    // // مهام واردة لم يعلق عليها اليوم
    // $income_tasks_not_commented = Task::whereHas('employees', function ($q) use ($users) {
    //     $q->where('user_id', $users);
    // })->whereDoesntHave('today_comments')->where('end_time', '>=', date('Y-m-d\TH:i'))->get();


    // // مهام صادرة لم يعلق عليها اليوم
    // $outcome_tasks_not_commented = Task::where('manager_id', $users)
    //     ->whereDoesntHave('today_comments')->where('end_time', '>=', date('Y-m-d\TH:i'))->get();


    // // مهام واردة أوشكت على الإغلاق
    // $income_tasks_almost_close = Task::whereHas('employees', function ($q) use ($users) {
    //     $q->where('user_id', $users);
    // })->where('start_time', '>=', date('Y-m-d\T00:00'))->where('end_time', '<=', date('Y-m-d\TH:i', strtotime('+3 Days')))->get();


    // // مهام صادرة أوشكت على الإغلاق
    // $outcome_tasks_almost_close = Task::where('manager_id', $users)
    //     ->where('start_time', '>=', date('Y-m-d\T00:00'))
    //     ->where('end_time', '<=', date('Y-m-d\TH:i', strtotime('+3 Days')))->get();

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

        // مهام واردة أوشكت على الإغلاق
        $income_tasks_almost_soon = Task::whereHas('employees', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->orWhere('manager_id', $user)
            ->where('start_time', '>=', date('Y-m-d\T00:00'))->where('end_time', '<=', date('Y-m-d\TH:i', strtotime('+3 Days')))
            ->get();

        // $tasks = Task::whereBetween('created_at', [Carbon::now(), Carbon::now()->addHours(12)])->get();

        return view('Web.repots.prints.closed-reports-soon', compact('user', 'income_tasks_almost_soon'));
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

    public function OutgoingTaskMovements(Request $request)
    {
        $user = $request->input('users');
        // مهام صادرة لم يعلق عليها اليوم
        $outcome_tasks_not_commented = Task::where('manager_id', $user)
            ->where('end_time', '>=', date('Y-m-d\TH:i'))->get();
            return  view('Web.repots.prints.outgoing-task-movements',compact('outcome_tasks_not_commented'));
            
    }

    public function IncomingTaskMovements(Request $request)
    {
       
        $user = $request->input('users');
        // مهام واردة أوشكت على الإغلاق
        $income_tasks_almost_close = Task::whereHas('employees', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->get();
        
        return view('Web.repots.prints.incoming-task-movements',compact('income_tasks_almost_close'));
    }

    public function FollowUpEmployeeTasks()
    {
        $tasks_status = Task::get();
        return view('Web.repots.prints.follow-up-employee-tasks');
    }

    public function IncomingTasksNotCommentedOnToday() {}
}
