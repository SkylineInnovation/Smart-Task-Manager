<?php

namespace App\Http\Controllers\Repo;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Leave;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewRepoController extends Controller
{
    public function repoIndex()
    {
        $tasksP1R1 = Task::where('status', 'active')->orderBy('id', 'desc')->get();

        $tasksP2R1 = Task::where('status', 'active')->orderBy('id', 'desc')->get();

        $tasksP2R2 = Task::where('status', 'active')->orderBy('id', 'desc')->get();

        $tasksP4R1 = Task::where('status', 'active')->orderBy('id', 'desc')->get();

        // $tasksP4R2 = Task::where('status', 'active')->orderBy('id', 'desc')->get();

        $user = Auth::user();

        if ($user->hasRole('owner')) {

            $employees = User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
        } elseif ($user->hasRole('employee')) {

            $employees = User::where('id', $user->id)->get();
        } else {

            $employees = $user->employees;
        }


        $managers = User::whereRoleIs('manager')->get();

        $employeesP8R1 = User::whereRoleIs('employee')->get();

        $managersP8R2 = User::whereRoleIs('manager')->get();

        $employeesP10R1 = User::WhereRoleIs('employee')->get();

        $employeesP11 = User::whereRoleIs('employee')->get();

        $employeesP12 = User::whereRoleIs('employee')->get();



        return view('Web.repo.new-repo-page', compact(
            'tasksP1R1',
            'tasksP2R1',
            'tasksP2R2',
            'tasksP4R1',
            'employees',
            'managers',
            'employeesP8R1',
            'managersP8R2',
            'employeesP10R1',
            'employeesP11',
            'employeesP12'
        ));
    }

    public function  p1R1(Request $request)
    {
        $taskIds = $request->input('taskIds');

        $tasks = new Task;

        if (!empty($taskIds)) {
            $tasks = $tasks->whereIn('id', $taskIds);
        }
        $tasks = $tasks->where('status', 'active');

        $tasks = $tasks->orderBy('id', 'desc')->get();

        return view('web.repo.table.p1-r1', compact('tasks'));
    }

    public function p2R1(Request $request)
    {
        $taskID = $request->input('taskIdr2p1');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');


        $comments = Comment::where('task_id', $taskID)->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();
        $task = Task::find($taskID);



        return view('web.repo.table.p2-r1', compact('task', 'comments'));
    }

    public function p2R2(Request $request)
    {

        $taskID = $request->input('taskIdr2p1');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');


        $taskIds = $request->input('taskIds');

        $tasks = new Task;

        if (!empty($taskIds)) {
            $tasks = $tasks->whereIn('id', $taskIds);
        }
        $tasks = $tasks->where('status', 'active');

        $tasks = $tasks->orderBy('id', 'desc')->get();

        return view('web.repo.table.p2-r2', compact(
            'tasks',
            'formDate',
            'toDate'
        ));
    }

    public function p4R1(Request $request)
    {

        $taskID = $request->input('taskIdr2p1');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $tasks = new Task;

        $tasks = $tasks->where('status', 'active');

        $tasks = $tasks->orderBy('id', 'desc')->get();

        return view('web.repo.table.p4-r1', compact(
            'tasks',
            'formDate',
            'toDate'
        ));
    }

    // secound card
    public function p4R2(Request $request)
    {
        $taskID = $request->input('taskIdr2p1');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $tasks = new Task;

        $tasks = $tasks->where('status', 'active');

        $tasks = $tasks->orderBy('id', 'desc')->get();

        return view('web.repo.table.p4-r2', compact(
            'tasks',
            'formDate',
            'toDate'
        ));
    }

    public function p6R1(Request $request)
    {

        $employe = $request->input('emp_id');

        $tasks = Task::whereHas('employees', function ($q) use ($employe) {

            $q->where('id', $employe);
        })->get();

        // dd($employe);

        return view('web.repo.table.p6-r1', compact('tasks'));
    }

    public function p6R2(Request $request)
    {

        $man_id = $request->input('man_id');
        $tasks = Task::where('manager_id', $man_id)->orderBy('id', 'desc')->get();

        return view('web.repo.table.p6-r2', compact('tasks'));
    }

    public function p8R1(Request $request)
    {

        $employID = $request->input('employeesP8R1_id');

        $employe = User::find($employID);

        $tasks = Task::whereHas('employees', function ($q) use ($employID) {
            $q->where('id', $employID);
        })->get();

        return view('web.repo.table.p8-r1', compact('tasks', 'employe'));
    }

    // TODO
    // DOne

    public function p8R2(Request $request)
    {
        $managerId = $request->input('managersP8R2_id');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $taskStatus = $request->input('taskStatus');
        $manager = User::find($managerId);

        if ($taskStatus == 1) {

            $tasks = Task::whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('manager_id', $managerId)
                ->where('status', 'active')
                ->get();
        } elseif ($taskStatus == 2) {
            $tasks = Task::whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('manager_id', $managerId)
                ->where('status', 'auto-finished')
                ->get();
        } else

            $tasks = Task::whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('manager_id', $managerId)
                ->where('slug', 'draft')
                ->get();


        return view('web.repo.table.p8-r2', compact('tasks', 'manager'));
    }


    // TODO
    // DONE
    public function p10R1(Request $request)
    {
        $emoloyeeID = $request->input('emp_id');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $taskStatus = $request->input('taskStatus');
        $emplyee = User::find($emoloyeeID);


        if ($taskStatus == 1) {

            $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
                $q->where('id', $emplyee->id);
            })
                ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('status', 'active')
                ->get();
        } elseif ($taskStatus == 2) {
            $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
                $q->where('id', $emplyee->id);
            })
                ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('status', 'auto-finished')
                ->get();
        } else

            $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
                $q->where('id', $emplyee->id);
            })
                ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
                ->where('slug', 'draft')
                ->get();


        return view('web.repo.table.p10-r1', compact('tasks'));
    }


    public function p11(Request $request)
    {

        $emplyee = $request->input('employees11_id');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
            $q->where('id', $emplyee);
        })
            ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
            ->get();

        return view('web.repo.table.p11', compact('tasks'));
    }

    public function p12(Request $request)
    {
        $emplyee = $request->input('employees12_id');
        $formDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $leaves = Leave::whereHas('user', function ($q) use ($emplyee) {
            $q->where('id', $emplyee);
        })
            ->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])
            ->paginate();

        // dd($leaves);

        return view('web.repo.table.p12', compact('leaves'));
    }


   
}
