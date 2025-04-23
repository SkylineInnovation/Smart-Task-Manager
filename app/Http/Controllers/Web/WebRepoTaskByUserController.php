<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ExchangePermission;
use App\Models\Leave;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebRepoTaskByUserController extends Controller
{
    public function repo_p6_r1_active($id)
    {

        $emp = User::find($id);

        $tasks = Task::whereHas('employees', function ($q) use ($emp) {
            $q->where('id', $emp->id);
        })->where('status', 'active')->get();
        $comments = new Comment();
        foreach ($tasks as $task)
            if ($comments)
                $comments = Comment::where('task_id', $task->id)->get();

        return view('web.task.user.repo_p6_r1_active', compact('tasks', 'comments'));
    }
    public function repo_p6_r1_closed_soon($id)
    {

        $employe = User::find($id);

        $tasks = Task::whereHas('employees', function ($q) use ($employe) {
            $q->where('id', $employe);
        })->get();

        return view('web.task.user.repo_p6_r1_close_soon', compact('tasks',));
    }


    public function repo_p6_r2($id)
    {

        $employe = User::find($id);

        $tasks = Task::where('manager_id', $employe->id)->get();


        return view('web.task.user.repo-p6-r2', compact('tasks'));
    }

    public function repo_p7_r1($id)
    {


        $employe = User::find($id);
        $tasks = Task::whereHas('employees', function ($q) use ($employe) {
            $q->where('id', $employe->id);
        })->get();

        return view('web.repo.table.p8-r1', compact('tasks', 'employe'));
    }


    public function repo_p8_R2($id)
    {

        $manager = User::find($id);

        $tasks = Task::where('manager_id', $manager->id)->get();


        foreach ($tasks as $task) {
            $formDate = $task->start_time;
            $toDate = $task->end_time;

            $taskStatus = $task->status;

            $tasks = Task::where('manager_id', $manager->id)
                ->where('status', 'active')
                ->get();



            return view('web.repo.table.p8-r2', compact('tasks', 'manager'));
        }
    }


    public function repo_p10_R1($id)
    {
        $emplyee = User::find($id);





        $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
            $q->where('id', $emplyee->id);
        })

            ->where('status', 'active')
            ->get();


        return view('web.repo.table.p10-r1', compact('tasks'));
    }


    public function repo_p11($id)
    {

        $emplyee = User::find($id);
        // $formDate = $request->input('fromDate');
        // $toDate = $request->input('toDate');

        $tasks = Task::whereHas('employees', function ($q) use ($emplyee) {
            $q->where('id', $emplyee->id);
        })

            ->get();

        return view('web.repo.table.p11', compact('tasks'));
    }


    public function repo_p12($id)
    {
        $emplyee = User::find($id);


        $leaves = Leave::whereHas('user', function ($q) use ($emplyee) {
            $q->where('id', $emplyee->id);
        })

            ->paginate();

        // dd($leaves);

        return view('web.repo.table.p12', compact('leaves'));
    }

    public function repo_p13($id)
    {
        $emplyee = User::find($id);


        $exchanges = ExchangePermission::whereHas('user', function ($q) use ($emplyee) {
            $q->where('id', $emplyee->id);
        })

            ->get();

        return view('web.repo.table.p13', compact('exchanges'));
    }
}
