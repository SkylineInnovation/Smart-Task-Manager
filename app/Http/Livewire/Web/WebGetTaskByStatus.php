<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\HomeController;
use App\Jobs\SendNewAttachment;
use App\Jobs\SendNewComment;
use App\Jobs\SendNewExtraTime;
use App\Jobs\SendNewLeave;
use App\Jobs\SendNewTask;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\ExtraTime;
use App\Models\Leave;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class WebGetTaskByStatus extends Component
{
    use WithFileUploads;

    public $status;
    public $user;

    public $admin_view_status = '', $by, $url;
    public function mount($status, $admin_view_status = '',)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->status = $status;

        $this->sub_task_start_time  = date('Y-m-d\TH:i');
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->leave_effect_on_time = false;

        $this->extratime_from_time = date('Y-m-d\TH:i');
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
    }

    public $task;
    public $task_id = 0;


    public $empTask;
    public function setTask($id)
    {
        $this->tab = 1;
        $task = Task::find($id);

        $this->task_id = $id;
        $this->task = $task;

        $this->employees = $this->task->employees;
        $this->selectedEmployees = $this->employees->pluck('id')->toArray();

        $this->sub_task_discount = $this->task->discount();

        // $this->sub_task_start_time  = date('Y-m-d\TH:i');
        // $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->sub_task_start_time  = $task->start_time;
        $this->sub_task_end_time  = $task->end_time;

        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->leave_effect_on_time = false;

        $this->extratime_from_time = date('Y-m-d\TH:i', strtotime($task->end_time));
        $this->extratime_to_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
    }

    public function openCommentTask($id)
    {
        $this->setTask($id);
        $this->changeTab(3);
    }


    public function rules()
    {
        if ($this->tab == 4) {
            return [
                'sub_task_title' => 'required',
                'sub_task_desc' => 'required',
                'sub_task_start_time' => 'required',
                'sub_task_end_time' => 'required',
                'sub_task_priority_level' => 'required',
                'sub_task_status' => 'required',
                'sub_task_discount' => 'required',
            ];
        } elseif ($this->tab == 7) {
            return [
                'sub_task_title' => 'required',
                'sub_task_desc' => 'required',
                'sub_task_start_time' => 'required',
                'sub_task_end_time' => 'required',
                'sub_task_priority_level' => 'required',
                'sub_task_status' => 'required',
                'selected_employe_task' => 'required',
            ];
        }

        return [
            'task_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'selectedEmployees.required' => 'Please Select Employee',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function startWithTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'active']);

        $this->emit('render-active'); // Close model to using to jquery
    }

    public function finishWithTask($id)
    {
        $task = Task::find($id);

        $is_admin = $this->by->hasRole('owner') || $this->by->hasRole('manager');
        if (!$is_admin && !$task->all_comments()) {
            $this->addError('error_finish_task', 'Can\'t Finish Task, Add Comment.');
            return;
        }

        $task->update(['status' => 'under-review']);

        $this->emit('render-manual-finished'); // Close model to using to jquery
    }

    public function acceptFinish($id)
    {
        $task = Task::find($id);

        $task->update(['status' => 'manual-finished']);

        $this->emit('render-manual-finished'); // Close model to using to jquery
    }

    public function setRejectTime($id)
    {
        $task = Task::find($id);

        $this->complete_new_end_time = date('Y-m-d\TH:i', strtotime($task->end_time . ' +1 Hours'));
        $this->reject_reason = '';
    }

    public $complete_new_end_time, $reject_reason;
    public function rejectFinish($id)
    {
        $task = Task::find($id);

        $task->update([
            'status' => 'active',
            // 'end_time' => date('Y-m-d\TH:i', strtotime('+1 Hours')),
            'end_time' => $this->complete_new_end_time,
        ]);

        $comment = Comment::create([
            'add_by' => $this->by->id,
            'task_id' => $id,
            'user_id' => $this->by->id,
            'desc' => $this->reject_reason,
        ]);

        $this->reject_reason = '';

        $this->emit('close-reject-comment-model', $this->id);


        $this->emit('render-manual-finished'); // Close model to using to jquery
    }


    public function draftTask($id)
    {
        $task = Task::find($id);
        $task->update(['slug' => 'draft']);

        $this->emit('render-manual-finished'); // Close model to using to jquery
    }

    public $attatchment_file, $attatchment_title, $attatchment_desc;
    public function addAttatchment()
    {
        $attachment = Attachment::create([
            'add_by' => $this->by->id,

            'user_id' => $this->by->id,
            'task_id' => $this->task_id,
            'title' => $this->attatchment_title,
            'desc' => $this->attatchment_desc,
            'file' => HomeController::saveImageWeb($this->attatchment_file, 'attachment'),
        ]);

        $this->attatchment_title = '';
        $this->attatchment_desc = '';
        $this->attatchment_file = null;

        if (env('SEND_MAIL', false))
            SendNewAttachment::dispatch($attachment);
    }


    public $comment_title, $comment_desc;
    public function addComment()
    {
        if ($this->user->hasRole('employee')) {
            $validatedData = $this->validate([
                'comment_desc' => 'required|min:60',
            ]);
        }

        $comment = Comment::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->comment_title,
            'desc' => $this->comment_desc,
            // 'replay_time' => $this->replay_time,
            // 'main_comment_id' => $this->main_comment_id,
        ]);

        $this->comment_title = '';
        $this->comment_desc = '';

        if (env('SEND_MAIL', false))
            SendNewComment::dispatch($comment);
    }

    public $comment_id, $replay_comment_title, $replay_comment_desc;

    public function setCommentId($id)
    {
        $this->comment_id = $id;
    }
    public function replayComment()
    {
        $comment = Comment::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->replay_comment_title,
            'desc' => $this->replay_comment_desc,
            // 'replay_time' => $this->replay_time,
            'main_comment_id' => $this->comment_id,
        ]);

        $this->replay_comment_title = '';
        $this->replay_comment_desc = '';

        $this->emit('close-replay-comment-model', $this->task_id);

        if (env('SEND_MAIL', false))
            SendNewComment::dispatch($comment);
    }

    public $employees;
    public $selectedEmployees;

    public $sub_task_discount;
    public $sub_task_title, $sub_task_desc,
        $sub_task_start_time, $sub_task_end_time,
        $sub_task_priority_level = 'low', $sub_task_status = 'pending';

    public $selected_employe_task = [];

    public function addSubTask()
    {
        $validatedData = $this->validate();

        $task = Task::create([
            'add_by' => $this->by->id,

            'manager_id' => $this->by->id,
            'title' => $this->sub_task_title,
            'desc' => $this->sub_task_desc,
            'start_time' => $this->sub_task_start_time,
            'end_time' => $this->sub_task_end_time,
            'priority_level' => $this->sub_task_priority_level,
            'status' => $this->sub_task_status,
            'main_task_id' => $this->task_id,
        ]);

        $task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->sub_task_discount]);

        if (env('SEND_MAIL', false))
            SendNewTask::dispatch($task);

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_end_time));
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_start_time . ' +1 Hours'));

        $this->sub_task_priority_level = 'low';

        // $this->selectedEmployees = [];

        $this->task = Task::find($this->task->id);

        $this->sub_task_discount = $this->task->discount();

        $this->select_emp = '';

        session()->flash('sub-task-message', 'Sub Task Created Successfully.');
    }

    public $select_emp;
    public function updatedSelectEmp($val)
    {
        $this->selectedEmployees[] = $val;
    }


    public $tab = 1;
    public function changeTab($index)
    {
        $this->tab = $index;
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
    }

    public $updateMode = false;
    public $edit_task_title, $edit_task_desc,
        $edit_task_start_time, $edit_task_end_time,
        $edit_task_priority_level, $edit_task_status;

    public $edit_task_selectedEmployees, $edit_task_discount;

    public function editTask($id)
    {
        $this->updateMode = true;
        $task = Task::find($id);
        // $this->task = $task;
        $this->task_id = $id;

        $this->edit_task_title = $task->title;
        $this->edit_task_desc = $task->desc;
        $this->edit_task_start_time = $task->start_time;
        $this->edit_task_end_time = $task->end_time;
        $this->edit_task_priority_level = $task->priority_level;
        $this->edit_task_status = $task->status;

        // $this->employees = $task->employees;
        if ($this->user->hasRole('owner')) {
            $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();
        } else {
            $this->employees = $this->user->employees;
        }

        $this->edit_task_selectedEmployees = $task->employees->pluck('id');

        $this->edit_task_discount = $task->discount();
    }

    public function updateTask()
    {
        $this->updateMode = true;
        $task = Task::find($this->task_id);

        if (in_array($task->status, ['auto-finished', 'manual-finished'])) {
            session()->flash('message', __('global.task-cant-be-updated'));
            $this->emit('show-message', ['message' => __('global.task-cant-be-updated')]); // show toster message
            return;
        }

        $validatedData = $this->validate([
            // 'edit_task_start_time' => 'required|date|after:' . date('Y-m-d\TH:i', strtotime('-5 Minutes')),
            'edit_task_end_time' => 'required|date|after:edit_task_start_time', // _or_equal
        ]);

        $task->update([
            'title' => $this->edit_task_title,
            'desc' => $this->edit_task_desc,
            'start_time' => $this->edit_task_start_time,
            'end_time' => $this->edit_task_end_time,
            'priority_level' => $this->edit_task_priority_level,
            'status' => $this->edit_task_status,
        ]);

        $task->employees()->syncWithPivotValues($this->edit_task_selectedEmployees, ['discount' => $this->edit_task_discount]);

        session()->flash('message', __('global.updated-successfully'));
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
    }

    public function cancelTask()
    {
        $this->updateMode = false;
    }

    public function deleteComents($id)
    {
        $comments = Comment::find($id);
        $comments->delete();
    }

    public function deleteAttatchment($id)
    {
        $attche = Attachment::find($id);
        $attche->delete();
    }

    public function deletecomment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    protected $listeners = [
        'refreshRender' => 'render'
    ];

    // 
    public $leave_type = 'leave', $leave_time_out, $leave_time_in, $leave_effect_on_time, $leave_reason, $leave_result;
    public function addLeaveRequest()
    {
        $leave = Leave::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'type' => $this->leave_type,
            'time_out' => $this->leave_time_out,
            'time_in' => $this->leave_time_in,
            'effect_on_time' => $this->leave_effect_on_time,
            'reason' => $this->leave_reason,
            'result' => $this->leave_result,
            'status' => 'pending',
            // 'accepted_by_user_id' => $this->accepted_by_user_id,
            // 'accepted_time' => $this->accepted_time,
        ]);

        $this->emit('close-leave-request-model', $this->task_id); // Close model to using to jquery

        if (env('SEND_MAIL', false))
            SendNewLeave::dispatch($leave);
    }

    public $extratime_from_time, $extratime_to_time, $extratime_reason, $extratime_duration;
    public function addExtraTime()
    {
        $from_date = Carbon::parse(date('Y-m-d h:i A', strtotime($this->extratime_from_time)));
        $to_date = Carbon::parse(date('Y-m-d h:i A', strtotime($this->extratime_to_time)));

        $dur = $from_date->diff($to_date);

        $extra_time = ExtraTime::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'from_time' => $this->extratime_from_time,
            'to_time' => $this->extratime_to_time,
            'reason' => $this->extratime_reason,
            'status' => 'pending',

            // 'accepted_by_user_id' => $this->accepted_by_user_id,

            'request_time' => date('Y-m-d h:i A'),

            // 'response_time' => $this->response_time,
            // 'duration' => $dur->format("%d day %h:%i:%s"),
        ]);

        $this->extratime_from_time = '';
        $this->extratime_to_time = '';
        $this->extratime_reason = '';

        $this->emit('close-extra-time-model', $this->task_id); // Close model to using to jquery

        if (env('SEND_MAIL', false))
            SendNewExtraTime::dispatch($extra_time);
    }

    public $extratime, $extratime_id;
    public function setExtraTime($id)
    {
        $this->extratime_id = $id;

        $extratime = ExtraTime::find($id);
        $this->extratime = $extratime;

        $this->extratime_from_time = $extratime->from_time;
        $this->extratime_to_time = $extratime->to_time;
        $this->extratime_reason = $extratime->reason;

        $this->cal_extratime_duration();

        $this->show_extratime = true;
    }

    public $show_extratime = false;
    public function acceptExtraTime()
    {
        $from_date = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_from_time)));
        $to_date = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_to_time)));

        $dur = $from_date->diff($to_date);

        $extratime = ExtraTime::find($this->extratime_id);

        $extratime->update([
            'accepted_by_user_id' => auth()->user()->id,
            'from_time' => $this->extratime_from_time,
            'to_time' => $this->extratime_to_time,
            'response_time' => date('Y-m-d h:i A'),
            // 'duration' => $dur->format("%d day %h:%i:%s"),
            'status' => 'accepted',
        ]);

        $task = Task::find($extratime->task_id);

        $task->update([
            'end_time' => $this->extratime_to_time,
        ]);

        $this->emit('close-accept-extra-time-model', $task->id); // Close model to using to jquery

        $this->show_extratime = false;
    }

    public function rejectExtraTime($id)
    {
        $extratime = ExtraTime::find($id);

        $extratime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }

    // // // // 
    public $leave, $leave_id;
    public function setLeave($id)
    {
        $this->leave_id = $id;

        $leave = Leave::find($id);
        $this->leave = $leave;

        $this->leave_type = $leave->type;
        $this->leave_time_out = $leave->time_out;
        $this->leave_time_in = $leave->time_in;
        $this->leave_effect_on_time = $leave->effect_on_time;
        $this->leave_reason = $leave->reason;
        $this->leave_result = $leave->result;

        $this->show_leave = true;
    }


    public $show_leave = false;
    public function acceptLeave()
    {
        $leaveTime = Leave::find($this->leave_id);

        $leaveTime->update([
            'type' => $this->leave_type,
            'time_out' => $this->leave_time_out,
            'time_in' => $this->leave_time_in,
            'effect_on_time' => $this->leave_effect_on_time,
            'status' => 'accepted',
            'accepted_by_user_id' => auth()->user()->id,
            'accepted_time' => date('Y-m-d h:i A'),
        ]);

        if ($this->leave_effect_on_time) {
            $task = Task::find($leaveTime->task_id);

            $task->update([
                'end_time' => $this->leave_time_in,
            ]);
        }

        $this->emit('close-accept-leave-model', $this->task_id); // Close model to using to jquery

    }

    public function rejectLeave($id)
    {
        $leaveTime = Leave::find($id);

        $leaveTime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }

    public function updatedExtratimeFromTime()
    {
        $this->cal_extratime_duration();
    }

    public function updatedExtratimeToTime()
    {
        $this->cal_extratime_duration();
    }

    public function cal_extratime_duration()
    {
        $startDate = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_from_time)));
        $endDate = Carbon::parse(date('Y-m-d h:i', strtotime($this->extratime_to_time)));

        $totalSeconds = $endDate->diffInSeconds($startDate);

        // Convert seconds to hours and minutes
        $hours = intval($totalSeconds / 3600);
        $minutes = intval(($totalSeconds % 3600) / 60);
        // 
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $result = $hours_string . ':' . $minutes_string . ':00';

        $this->extratime_duration = $result;
    }

    public function startSubTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'active']);
    }

    public function completeSubTask($id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'manual-finished']);
    }


    public function employeeCreatTask()
    {
        $validatedData = $this->validate();


        $empTask = Task::create([

            'add_by' => $this->by->id,
            'manager_id' => $this->by->id,
            'title' => $this->sub_task_title,
            'desc' => $this->sub_task_desc,
            'start_time' => $this->sub_task_start_time,
            'end_time' => $this->sub_task_end_time,
            'priority_level' => $this->sub_task_priority_level,
            'status' => $this->sub_task_status,
            'main_task_id' => $this->task_id,

        ]);

        $empTask->employees()->syncWithPivotValues($this->selected_employe_task, ['discount' => 0]);

        if (env('SEND_MAIL', false))
            SendNewTask::dispatch($empTask);

        $this->sub_task_title = null;
        $this->sub_task_desc = null;

        $this->sub_task_start_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_end_time));
        $this->sub_task_end_time  = date('Y-m-d\TH:i', strtotime($this->sub_task_start_time . ' +1 Hours'));

        $this->sub_task_priority_level = 'low';

        $this->selected_employe_task = [];

        $this->task = Task::find($this->task->id);


        session()->flash('emp-task-message', 'emp Task Created Successfully.');
    }

    public function render()
    {
        $tasks = Task::whereNullOrEmpty('slug')
            ->whereNullOrEmptyOrZero('main_task_id')
            ->where('status', $this->status);

        if ($this->user->hasRole('employee')) {
            $tasks = $tasks->whereHas('employees', function ($q) {
                $q->where('user_id', $this->user->id);
            });
        }

        if ($this->user->hasRole('manager')) {
            $tasks = $tasks->orWhere('manager_id', $this->user->id);
        }


        // $date = date('Y-m-d\TH:i', strtotime('-1 days'));

        // $tasks = $tasks->where('end_time', '>', $date);

        // ->where('end_time', '<=', $date)->get();
        $tasks = $tasks->orderBy('id', 'desc')->get();



        return view('livewire.web.web-get-task-by-status', compact('tasks'));
    }
}
