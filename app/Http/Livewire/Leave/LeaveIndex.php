<?php

namespace App\Http\Livewire\Leave;

use App\Jobs\SendNewLeave;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $search = '';
    public $orderBy = 'id';
    public $orderWay = 'desc';
    public $showColumn;

    public $all;
    public $fromDate = null;
    public $toDate = null;
    public $byDate = 'created_at';

    public $selectedLeaves = [];

    public Leave $leave;
    private $leaves;
    public $user;


    public $tasks = [];

    public $users = [];

    public $accepted_by_users = [];



    public $filter_tasks_id = [];

    public $filter_users_id = [];

    public $filter_accepted_by_users_id = [];



    public $the_user_id;
    public $the_task_id;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $user_id = null, $task_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->leave = new Leave();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');


        if ($user_id) {
            $this->user_id = $user_id;
            $this->the_user_id = $user_id;
        }

        if ($task_id) {
            $this->task_id = $task_id;
            $this->the_task_id = $task_id;
        }

        $this->time_out = date('Y-m-d\TH:i');
        $this->time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->tasks = \App\Models\Task::whereNullOrEmptyOrZero('main_task_id')->where('show', 1)->orderBy('sort')->get();

        $this->users = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();

        // $this->accepted_by_users = \App\Models\User::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'task_id' => true,
            'user_id' => true,
            'type' => false,
            'time_out' => true,
            'time_in' => true,
            'effect_on_time' => true,
            'reason' => false,
            'result' => false,
            'status' => true,
            'accepted_by_user_id' => true,
            'accepted_time' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $leave_id, $task_id, $user_id, $type = 'leave', $time_out, $time_in, $effect_on_time = false, $reason, $result, $status = 'pending', $accepted_by_user_id, $accepted_time;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->task_id = null;
        // $this->user_id = null;
        $this->type = 'leave';
        $this->time_out = date('Y-m-d\TH:i');
        $this->time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->effect_on_time = false;
        $this->reason = '';
        $this->result = '';
        $this->status = 'pending';
        $this->accepted_by_user_id = null;
        $this->accepted_time = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'task_id' => 'required',
            'user_id' => 'required',
            // 'type' => 'required',
            // 'time_out' => 'required',
            // 'time_in' => 'required',
            // 'effect_on_time' => 'required',
            'reason' => 'required',
            // 'result' => 'required',
            // 'status' => 'required',
            // 'accepted_by_user_id' => 'required',
            // 'accepted_time' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $leave = Leave::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'time_out' => $this->time_out,
            'time_in' => $this->time_in,
            'effect_on_time' => $this->effect_on_time,
            'reason' => $this->reason,
            'result' => $this->result,
            'status' => $this->status,
            'accepted_by_user_id' => $this->accepted_by_user_id,
            'accepted_time' => $this->accepted_time,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message

        if (env('SEND_MAIL', false))
            SendNewLeave::dispatch($leave);
    }

    public function edit($id)
    {
        $this->show = true;
        $this->updateMode = true;
        $leave = Leave::find($id);
        $this->leave = $leave;
        $this->leave_id = $id;
        $this->slug = $leave->slug;


        $this->task_id = $leave->task_id;
        $this->user_id = $leave->user_id;
        $this->type = $leave->type;
        $this->time_out = $leave->time_out;
        $this->time_in = $leave->time_in;
        $this->effect_on_time = $leave->effect_on_time;
        $this->reason = $leave->reason;
        $this->result = $leave->result;
        $this->status = $leave->status;
        $this->accepted_by_user_id = $leave->accepted_by_user_id;
        $this->accepted_time = $leave->accepted_time;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->leave_id) {
            $leave = Leave::find($this->leave_id);
            $leave->update([
                'slug' => $this->slug,

                'task_id' => $this->task_id,
                'user_id' => $this->user_id,
                'type' => $this->type,
                'time_out' => $this->time_out,
                'time_in' => $this->time_in,
                'effect_on_time' => $this->effect_on_time,
                'reason' => $this->reason,
                'result' => $this->result,
                'status' => $this->status,
                'accepted_by_user_id' => $this->accepted_by_user_id,
                'accepted_time' => $this->accepted_time,
            ]);

            $this->updateMode = false;
            session()->flash('message', __('global.updated-successfully'));
            $this->resetInputFields();
            $this->emit('close-model'); // Close model to using to jquery
            $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
        }
    }

    public function delete($id)
    {
        if ($id) {
            $leave = Leave::find($id);

            $leave->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $leave = Leave::withTrashed()->find($id);

            $leave->restore();

            session()->flash('message', __('global.recovered-successfully'));
            $this->emit('show-message', ['message' => __('global.recovered-successfully')]); // show toster message
        }
    }

    public function updatedFromDate($fromDate)
    {
        $this->all = false;
    }

    public function updatedToDate($toDate)
    {
        $this->all = false;
    }

    public function clearFilter()
    {
        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->byDate = 'created_at';
        $this->fromDate = '';
        $this->toDate = date('Y-m-d');


        $this->filter_tasks_id = [];

        $this->filter_users_id = [];

        $this->filter_accepted_by_users_id = [];

        $this->select_task = '';
        $this->select_user = '';
        $this->select_accepted_by_user = '';
    }


    public $select_task;
    public function updatedSelectTask($val)
    {
        $this->filter_tasks_id[] = $val;
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
    }


    public $select_accepted_by_user;
    public function updatedSelectAcceptedByUser($val)
    {
        $this->filter_accepted_by_users_id[] = $val;
    }




    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }


    public $show = false;
    public function acceptLeave()
    {
        $leaveTime = Leave::find($this->leave_id);

        $leaveTime->update([
            'type' => $this->type,
            'time_out' => $this->time_out,
            'time_in' => $this->time_in,
            'effect_on_time' => $this->effect_on_time,
            'reason' => $this->reason,
            'status' => 'accepted',
            'accepted_by_user_id' => auth()->user()->id,
            'accepted_time' => date('Y-m-d h:i A'),
        ]);

        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message

    }

    public function rejectLeave($id)
    {
        $leaveTime = Leave::find($id);

        $leaveTime->update([
            'response_time' => date('Y-m-d h:i A'),
            'status' => 'rejected',
        ]);
    }

    public function render()
    {
        $leaves = Leave::livewireSearch($this->search);

        if ($this->all == false)
            $leaves = $leaves->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_tasks_id)
            $leaves = $leaves->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_users_id)
            $leaves = $leaves->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_accepted_by_users_id)
            $leaves = $leaves->whereIn('accepted_by_user_id', $this->filter_accepted_by_users_id);

        if ($this->the_user_id)
            $leaves = $leaves->where('user_id', $this->the_user_id);
        if ($this->the_task_id)
            $leaves = $leaves->where('task_id', $this->the_task_id);


        if ($this->admin_view_status == 'deleted')
            $leaves = $leaves->onlyTrashed();


        $leaves = $leaves->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.leave.leave-index', compact('leaves'));
    }
}
