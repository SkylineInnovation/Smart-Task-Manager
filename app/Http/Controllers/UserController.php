<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.user-home');
    }

    public function show(User $user)
    {
        return view('pages.user.user-show', compact('user'));
    }

    public function showReport($id)
    {
        $user = User::find($id);

        $tasks = new Task;

        // if ($this->all == false)
        //     $tasks = $tasks->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);

        $tasks = $tasks->whereNullOrEmptyOrZero('main_task_id');

        $tasks = $tasks->whereHas('employees', function ($q) use ($id) {
            $q->where('user_id', $id);
        });

        $tasks = $tasks->orderBy('created_at', 'desc')->get();

        return view('pages.user.user-report', compact('user', 'tasks'));
    }
}
