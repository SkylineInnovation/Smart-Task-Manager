<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class WebRepoTaskController extends Controller
{
    public function repo_p2_r1($id)
    {
        $taskID = Task::find($id);
        $formDate = $taskID->start_time;
        $toDate = $taskID->end_time;


        $comments = Comment::where('task_id', $taskID)->whereBetween('created_at', [$formDate . ' 00:00:00', $toDate . ' 23:59:59'])->get();


        $task = Task::find($id);

        return view('web.task.repo.repo_p2_r1', compact('task', 'comments'));
    }

    public function repo_p6_r2($id)
    {

        $man_id = Task::find($id);
        $task = Task::where('manager_id', $man_id->manager_id)->latest()->first();
        return view('web.task.repo.repo_p6_r2', compact('task'));
    }

    public function repo_p8_r1($id)
    {

        $task = Task::find($id);

        foreach ($task->employees as $empT)
            $tasks = Task::whereHas('employees', function ($q) use ($empT) {
                $q->where('id', $empT->id);
            })->find($task->id);

        return view('web.task.repo.repo_p8_r1', compact('tasks', 'task'));
    }

    public function repo_p8_r2($id)
    {

        $task = Task::find($id);

        $managerId = $task->manager_id;

        $taskM = Task::where('manager_id', $managerId)->where('status', 'active')->findOrFail($task->id);


        return view('web.task.repo.repo_p8_r2', compact('taskM'));
    }


    
}
