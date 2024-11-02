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

    public function showReport(Request $request, $id)
    {
        $user = User::find($id);

        $tasks = new Task;

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        if ($from_date && $to_date) {
            $by_date = 'created_at';
            $from_date =  date('Y-m-d', strtotime($from_date));
            $to_date =  date('Y-m-d', strtotime($to_date));

            $tasks = $tasks->whereBetween($by_date, [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
        }

        $tasks = $tasks->whereNullOrEmptyOrZero('main_task_id');

        $tasks = $tasks->whereHas('employees', function ($q) use ($id) {
            $q->where('user_id', $id);
        });

        $tasks = $tasks->orderBy('created_at', 'desc')->get();

        return view('pages.user.user-report', compact('user', 'tasks'));
    }
}
