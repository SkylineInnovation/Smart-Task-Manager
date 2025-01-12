<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function indexReport(Request $request)
    {

        $users = User::orderBy('first_name')->get();

        $userManager = User::whereRoleIs(['manager', 'owner'])->orderBy('id', 'desc')->get();


        $tasks = Task::get();


        $tasks_status = Task::whereIn('status', [
            'pending',
            'active',
            'auto-finished',
            'manual-finished',
        ])->select('status')->distinct()->get();


        $employees = User::whereRoleIs('employee')->get();


        return  view('Web.repots.web-index-reports', compact('users', 'tasks_status', 'userManager', 'tasks', 'employees'));
    }

    // public function discountsOutgoingTasksRequest(Request $request)
    // {
    //     $status = $request->input('status');
    //     $user = $request->input('user');

    //     $formDate = $request->input('fromDate');
    //     $toDate = $request->input('toDate');

    //     $userName = User::find($user);

    //     $tasks = Task::orWhereHas('employees', function ($q) use ($user) {
    //         $q->where('user_id', $user);
    //     })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
    //         ->where('status', $status)->get();

    //     $totalTasks = Task::orWhereHas('employees', function ($q) use ($user) {
    //         $q->where('user_id', $user);
    //     })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
    //         ->where('status', $status)->count();

    //     $totalTasksAmount = Task::orWhereHas('employees', function ($q) use ($user) {
    //         $q->where('user_id', $user);
    //     })->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
    //         ->where('status', $status)->get();

    //     foreach ($totalTasksAmount as $totalAmount)
    //         $totalAmount = Discount::where('user_id', $userName->id)->sum('amount');


    //     return view('Web.repots.new-prints.discounts-outgoing-tasks', [
    //         'tasks' => $tasks,
    //         'user' => $user,
    //         'userName' => $userName,
    //         'totalTasks' => $totalTasks,
    //         'totalTasksAmount' => $totalTasksAmount,
    //         'totalAmount' => $totalAmount ?? 0,
    //     ]);
    // }

    // public function MovementOfOutGoingTasksAccordingToThAassignedAuthority()
    // {
    //     return view('Web.repots.new-prints.Movement-of-outgoing-tasks-according-to-the-assigned-authority');
    // }

    // public function incomingTasksMovementForTheEmployee()
    // {
    //     return view('Web.repots.new-prints.Incoming-tasks-movement-for-the-employee');
    // }

    // 
    // 
    // 
    // 
    // 
    // 
    // 
    // 
    // 
    // 

    public function totalDicountByManager(Request $request, User $manager)
    {

        $from_date = $request->input('from_date');
        // $from_date = $from_date . ' 00:00:00';

        $to_date = $request->input('to_date');
        // $to_date = $to_date . ' 23:59:59';

        $by_date = $request->input('by_date', 'created_at');

        $employees = User::whereHas('managers', function ($q) use ($manager) {
            $q->where('id', $manager->id);
        })->get();

        return view('Web.repots.new-prints.total-dicount-by-manager', compact(
            'manager',
            'employees',
            'from_date',
            'to_date',
            'by_date',
        ));
    }

    public function listOfTasksComments(Request $request)
    {
        $taskSelect = $request->input('taskCheck');

        $viewTasks = Task::whereIn('id', $taskSelect)->get();

        return view('Web.repots.new-prints.task-specific-comments', compact('viewTasks'));
    }

    public function commentsOnAllTasks(Request $request)
    {
        $manager = $request->input('user', 0);
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $by_date = $request->input('by_date', 'created_at');

        $tasks = new Task;

        if ($manager != 0)
            $tasks = $tasks->where('manager_id', $manager);

        if ($from_date && $to_date && $by_date)
            $tasks = $tasks->whereBetween($by_date, [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);

        $tasks = $tasks->get();


        return view('Web.repots.new-prints.comments-on-all-tasks', compact('tasks'));
    }

    public function oneTaskComments(Task $task)
    {
        return view('Web.repots.new-prints.one-task-comments', compact('task'));
    }

    public function discountsReport(User $user)
    {
        $discounts = Discount::where('user_id', $user->id)->get();

        return view('Web.repots.new-prints.incoming-discounts-report', compact('user', 'discounts'));
    }

    public function tasksShortDesc(Request $request)
    {
        $manager = $request->input('user', 0);
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $by_date = $request->input('by_date', 'created_at');

        $tasks = new Task;

        if ($manager != 0)
            $tasks = $tasks->where('manager_id', $manager);

        if ($from_date && $to_date && $by_date)
            $tasks = $tasks->whereBetween($by_date, [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);

        $tasks = $tasks->get();


        return view('Web.repots.new-prints.tasks-short-desc', compact('tasks'));
    }

    // 
    // 
    // 
    // 

    public function employeeFollowUp(Request $request, User $user)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $by_date = $request->input('by_date', 'created_at');

        $tasks = new Task;

        $tasks = $tasks->whereHas('employees', function ($q) use ($user) {
            $q->where('id', $user->id);
        });

        if ($from_date && $to_date && $by_date)
            $tasks = $tasks->whereBetween($by_date, [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);

        $tasks = $tasks->get();

        return view('Web.repots.new-prints.employee-follow-up', compact('user', 'tasks'));
    }
}
