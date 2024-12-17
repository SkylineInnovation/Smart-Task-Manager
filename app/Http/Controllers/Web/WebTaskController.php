<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExchangePermission;
use App\Models\ExtraTime;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
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

    public function acceptExchange($userID, $id)
    {
        $user = User::find($userID);

        $id = Crypt::decryptString($id);
        $exchangepermission = ExchangePermission::find($id);
        if ($user->hasRole('financial')) {
            $exchangepermission->update([
                'financial_director_id' => $user->id,
                'financial_director_response' => 'accepted',
                'financial_director_time' => date('Y-m-d H:i'),
            ]);
        }

        if ($user->hasRole('technical')) {
            $exchangepermission->update([
                'technical_director_id' => $user->id,
                'technical_director_response' => 'accepted',
                'technical_director_time' => date('Y-m-d H:i'),
            ]);
        }

        $exchangepermission = ExchangePermission::find($id);

        if ($exchangepermission->financial_director_response == 'accepted' && $exchangepermission->technical_director_response == 'accepted') {
            $exchangepermission->update(['status' => 'accepted']);
        }

        return view('pages.crud.exchangepermission.exchangepermission-accepted');
    }

    public function rejectExchange($userID, $id)
    {
        $user = User::find($userID);

        $id = Crypt::decryptString($id);
        $exchangepermission = ExchangePermission::find($id);
        if ($user->hasRole('financial')) {
            $exchangepermission->update([
                'financial_director_id' => $user->id,
                'financial_director_response' => 'rejected',
                'financial_director_time' => date('Y-m-d H:i'),
            ]);
        }

        if ($user->hasRole('technical')) {
            $exchangepermission->update([
                'technical_director_id' => $user->id,
                'technical_director_response' => 'rejected',
                'technical_director_time' => date('Y-m-d H:i'),
            ]);
        }

        $exchangepermission = ExchangePermission::find($id);

        if ($exchangepermission->financial_director_response == 'rejected' || $exchangepermission->technical_director_response == 'rejected') {
            $exchangepermission->update(['status' => 'rejected']);
        }

        return view('pages.crud.exchangepermission.exchangepermission-rejected');
    }


    public function acceptExtraTime($userID, $id)
    {
        $user = User::find($userID);
        $id = Crypt::decryptString($id);

        $extratime = ExtraTime::find($id);

        $extratime->update([
            'accepted_by_user_id' => $user->id,
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'accepted',
        ]);

        $task = Task::find($extratime->task_id);

        $task->update([
            'end_time' => $extratime->to_time,
        ]);
    }

    public function rejectExtraTime($userID, $id)
    {
        $user = User::find($userID);
        $id = Crypt::decryptString($id);

        $extratime = ExtraTime::find($id);

        $extratime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }
}
