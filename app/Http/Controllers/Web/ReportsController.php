<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    public function indexReport(Request $request)

    {

        $users = User::orderBy('first_name')->get();

        $userManager = User::whereRoleIs(['manager', 'owner'])->orderBy('id', 'desc')->get();


        $tasks = Task::get();


        $tasks_status = Task::select('status')->whereIn('status', [
            'pending',
            'active',
            'auto-finished',
            'manual-finished',
        ])->distinct()->get();


        return  view('Web.repots.web-index-reports', compact('users', 'tasks_status', 'userManager', 'tasks'));
    }


    public function discountsOutgoingTasksRequest(Request $request)
    {
        $status = $request->input('status');
        $user = $request->input('user');

        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $userName = User::find($user);

        $tasks = Task::orWhereHas('employees', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
            ->where('status', $status)->get();

        $totalTasks = Task::orWhereHas('employees', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
            ->where('status', $status)->count();

        $totalTasksAmount = Task::orWhereHas('employees', function ($q) use ($user) {
            $q->where('user_id', $user);
        })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
            ->where('status', $status)->get();

        foreach ($totalTasksAmount as $totalAmount)
            $totalAmount = Discount::where('user_id', $userName->id)->sum('amount');


        return view('Web.repots.new-prints.discounts-outgoing-tasks', [
            'tasks' => $tasks,
            'user' => $user,
            'userName' => $userName,
            'totalTasks' => $totalTasks,
            'totalTasksAmount' => $totalTasksAmount,
            'totalAmount' => $totalAmount ?? 0,
        ]);
    }
    public function commentsOnAllTasks(Request $request)
    {
        $user = $request->input('user');
        $formDate = $request->input('formDate');
        $toDate = $request->input('toDate');
        if ($formDate == null && $toDate == null) { {
                $tasks = Task::where('manager_id', $user)->get();
            }
        } else {
            $tasks = Task::where('manager_id', $user)
                ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->get();
        }

        return view('Web.repots.new-prints.comments-on-all-tasks', compact('tasks'));
    }

    public function importantComments(Task $task)
    {

        return view('Web.repots.new-prints.important-comments', compact('task'));
    }




    public function taskSpecificComments(Request $request)
    {

        $taskSelect[] = $request->input('taskCheck');
        foreach ($taskSelect as $arr => $ts) {
            $viewTasks = Task::whereIn('id', $ts)->get();
        }




        return view('Web.repots.new-prints.task-specific-comments', compact('viewTasks'));
    }


    public function incomingDiscountsReport()
    {
        return view('Web.repots.new-prints.incoming-discounts-report');
    }

    public function MovementOfOutGoingTasksAccordingToThAassignedAuthority()
    {
        return view('Web.repots.new-prints.Movement-of-outgoing-tasks-according-to-the-assigned-authority');
    }

    public function incomingTasksMovementForTheEmployee()
    {
        return view('Web.repots.new-prints.Incoming-tasks-movement-for-the-employee');
    }
    public function shortTaskLog()
    {
        return view('Web.repots.new-prints.Short-task-log');
    }

    public function FollowUpOnEmployeeTasks()
    {
        return view('Web.repots.new-prints.Follow-up-on-employee-tasks2');
    }
}
