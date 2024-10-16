<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Crypt;

class WebTaskController extends Controller
{
    public function openTask($slug)
    {
        $id = Crypt::decryptString($slug);

        $task = Task::find($id);

        if (!$task) return view('stander.no-task');

        return view('pages.crud.task.task-show', compact('task'));
    }
}
