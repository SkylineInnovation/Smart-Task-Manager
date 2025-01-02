<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function discountsOutgoingTasks()
    {
        return view('Web.repots.new-prints.discounts-outgoing-tasks');
    }

    public function commentsOnAllTasks()
    {
        return view('Web.repots.new-prints.comments-on-all-tasks');
    }

    public function importantComments()
    {
        return view('Web.repots.new-prints.important-comments');
    }

    public function taskSpecificComments()
    {
        return view('Web.repots.new-prints.task-specific-comments');
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
