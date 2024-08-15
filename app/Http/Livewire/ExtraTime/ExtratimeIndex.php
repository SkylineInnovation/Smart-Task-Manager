<?php

namespace App\Http\Livewire\Extratime;

use App\Models\ExtraTime;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class ExtratimeIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 25;
    public $search = '';
    public $orderBy = 'id';
    public $orderWay = 'desc';
    public $showColumn;

    public $all;
    public $fromDate = null;
    public $toDate = null;
    public $byDate = 'created_at';

    public $selectedExtraTimes = [];

    public ExtraTime $extratime;
    private $extratimes;
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

        $this->extratime = new ExtraTime();

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

        $this->request_time = date('Y-m-d\TH:i');
        $this->from_time = date('Y-m-d\TH:i');
        $this->to_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        // $this->response_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->tasks = \App\Models\Task::whereNullOrEmptyOrZero('main_task_id')->where('show', 1)->orderBy('sort')->get();

        $this->users = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();

        // $this->accepted_by_users = \App\Models\User::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'task_id' => true,
            'user_id' => true,
            'accepted_by_user_id' => true,
            'reason' => true,
            'result' => false,
            'request_time' => true,
            'from_time' => true,
            'to_time' => true,
            'response_time' => false,
            'status' => true,
            'duration' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $extratime_id, $task_id, $user_id, $accepted_by_user_id, $reason, $result, $request_time, $from_time, $to_time, $response_time, $status = 'pending', $duration;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->task_id = null;
        // $this->user_id = null;
        $this->accepted_by_user_id = null;
        $this->reason = '';
        $this->result = '';
        $this->request_time = date('Y-m-d\TH:i');
        $this->from_time = date('Y-m-d\TH:i');
        $this->to_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->response_time = null;
        $this->status = 'pending';
        $this->duration = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'task_id' => 'required',
            // 'user_id' => 'required',
            // 'accepted_by_user_id' => 'required',
            // 'reason' => 'required',
            // 'result' => 'required',
            // 'request_time' => 'required',
            // 'from_time' => 'required',
            // 'to_time' => 'required',
            // 'response_time' => 'required',
            // 'status' => 'required',
            'duration' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        ExtraTime::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'accepted_by_user_id' => $this->accepted_by_user_id,
            'reason' => $this->reason,
            'result' => $this->result,
            'request_time' => $this->request_time,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'response_time' => $this->response_time,
            'status' => $this->status,
            'duration' => $this->duration,
        ]);

        session()->flash('message', 'ExtraTime Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->show = true;
        $this->updateMode = true;
        $extratime = ExtraTime::find($id);
        $this->extratime = $extratime;
        $this->extratime_id = $id;
        $this->slug = $extratime->slug;


        $this->task_id = $extratime->task_id;
        $this->user_id = $extratime->user_id;
        $this->accepted_by_user_id = $extratime->accepted_by_user_id;
        $this->reason = $extratime->reason;
        $this->result = $extratime->result;
        $this->request_time = $extratime->request_time;
        $this->from_time = $extratime->from_time;
        $this->to_time = $extratime->to_time;
        $this->response_time = $extratime->response_time;
        $this->status = $extratime->status;
        $this->duration = $extratime->duration;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->extratime_id) {
            $extratime = ExtraTime::find($this->extratime_id);
            $extratime->update([
                'slug' => $this->slug,

                'task_id' => $this->task_id,
                'user_id' => $this->user_id,
                'accepted_by_user_id' => $this->accepted_by_user_id,
                'reason' => $this->reason,
                'result' => $this->result,
                'request_time' => $this->request_time,
                'from_time' => $this->from_time,
                'to_time' => $this->to_time,
                'response_time' => $this->response_time,
                'status' => $this->status,
                'duration' => $this->duration,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'ExtraTime Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $extratime = ExtraTime::find($id);

            $extratime->delete();

            session()->flash('message', 'ExtraTime Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $extratime = ExtraTime::withTrashed()->find($id);

            $extratime->restore();

            session()->flash('message', 'ExtraTime Recovered Successfully.');
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
    public function updatedSelectAccepted_by_user($val)
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
    public function acceptExtraTime()
    {
        $from_date = Carbon::parse(date('Y-m-d H:i:s', strtotime($this->from_time)));
        $to_date = Carbon::parse(date('Y-m-d H:i:s', strtotime($this->to_time)));

        $dur = $from_date->diff($to_date);

        $extratime = ExtraTime::find($this->extratime_id);

        $extratime->update([
            'accepted_by_user_id' => auth()->user()->id,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'response_time' => date('Y-m-d H:i A'),
            // 'duration' => $dur->format("%d day %h:%i:%s"),
            'status' => 'accepted',
        ]);

        $task = Task::find($extratime->task_id);

        $task->update([
            'end_time' => $this->to_time,
        ]);

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function rejectExtraTime($id)
    {
        $extratime = ExtraTime::find($id);

        $extratime->update([
            'response_time' => date('Y-m-d H:i A'),
            'status' => 'rejected',
        ]);
    }

    public function render()
    {
        $extratimes = ExtraTime::livewireSearch($this->search);

        if ($this->all == false)
            $extratimes = $extratimes->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_tasks_id)
            $extratimes = $extratimes->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_users_id)
            $extratimes = $extratimes->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_accepted_by_users_id)
            $extratimes = $extratimes->whereIn('accepted_by_user_id', $this->filter_accepted_by_users_id);

        if ($this->the_user_id)
            $extratimes = $extratimes->whereIn('user_id', $this->the_user_id);
        if ($this->the_task_id)
            $extratimes = $extratimes->whereIn('task_id', $this->the_task_id);


        if ($this->admin_view_status == 'deleted')
            $extratimes = $extratimes->onlyTrashed();


        $extratimes = $extratimes->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.extratime.extratime-index', compact('extratimes'));
    }
}
