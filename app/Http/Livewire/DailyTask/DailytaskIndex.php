<?php

namespace App\Http\Livewire\Dailytask;

use App\Models\DailyTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class DailytaskIndex extends Component
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

    public $selectedDailyTasks = [];

    public DailyTask $dailytask;
    private $dailytasks;
    public $user;


    public $managers = [];



    public $filter_managers_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->dailytask = new DailyTask();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->managers = \App\Models\User::orderBy('name')->get();


        $this->showColumn = collect([
            'id' => true,
            'slug' => false,


            'manager_id' => true,
            'title' => true,
            'description' => true,
            'start_time' => true,
            'end_time' => true,
            'proearty' => true,
            'status' => true,
            'repeat_time' => true,
            'repeat_evrey' => true,

            // 'status' => false,
            'date' => true,
            'time' => true,
        ]);
    }

    public $slug;
    public $dailytask_id, $manager_id, $title, $description, $start_time, $end_time, $proearty, $status, $repeat_time, $repeat_evrey;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->manager_id = null;
        $this->title = '';
        $this->description = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->proearty = '';
        $this->status = '';
        $this->repeat_time = '';
        $this->repeat_evrey = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'manager_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'proearty' => 'required',
            'status' => 'required',
            'repeat_time' => 'required',
            'repeat_evrey' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        DailyTask::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'manager_id' => $this->manager_id,
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'proearty' => $this->proearty,
            'status' => $this->status,
            'repeat_time' => $this->repeat_time,
            'repeat_evrey' => $this->repeat_evrey,
        ]);

        session()->flash('message', 'DailyTask Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $dailytask = DailyTask::find($id);
        $this->dailytask = $dailytask;
        $this->dailytask_id = $id;
        $this->slug = $dailytask->slug;


        $this->manager_id = $dailytask->manager_id;
        $this->title = $dailytask->title;
        $this->description = $dailytask->description;
        $this->start_time = $dailytask->start_time;
        $this->end_time = $dailytask->end_time;
        $this->proearty = $dailytask->proearty;
        $this->status = $dailytask->status;
        $this->repeat_time = $dailytask->repeat_time;
        $this->repeat_evrey = $dailytask->repeat_evrey;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->dailytask_id) {
            $dailytask = DailyTask::find($this->dailytask_id);
            $dailytask->update([
                'slug' => $this->slug,

                'manager_id' => $this->manager_id,
                'title' => $this->title,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'proearty' => $this->proearty,
                'status' => $this->status,
                'repeat_time' => $this->repeat_time,
                'repeat_evrey' => $this->repeat_evrey,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'DailyTask Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $dailytask = DailyTask::find($id);

            $dailytask->delete();

            session()->flash('message', 'DailyTask Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $dailytask = DailyTask::withTrashed()->find($id);

            $dailytask->restore();

            session()->flash('message', 'DailyTask Recovered Successfully.');
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


        $this->filter_managers_id = [];
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
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

    public function render()
    {
        $dailytasks = DailyTask::livewireSearch($this->search);

        if ($this->all == false)
            $dailytasks = $dailytasks->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_managers_id)
            $dailytasks = $dailytasks->whereIn('manager_id', $this->filter_managers_id);


        if ($this->admin_view_status == 'deleted')
            $dailytasks = $dailytasks->onlyTrashed();


        $dailytasks = $dailytasks->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.dailytask.dailytask-index', compact('dailytasks'));
    }
}
