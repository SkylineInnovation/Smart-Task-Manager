<?php

namespace App\Http\Livewire\Completepercentage;

use App\Models\CompletePercentage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class CompletepercentageIndex extends Component
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

    public $selectedCompletePercentages = [];

    public CompletePercentage $completepercentage;
    private $completepercentages;
    public $user;


    public $tasks = [];

    public $users = [];



    public $filter_tasks_id = [];

    public $filter_users_id = [];

    public $the_task;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_task = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->completepercentage = new CompletePercentage();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');

        if ($the_task) {
            $this->the_task = $the_task;
            $this->task_id = $the_task->id;
        }

        // $this->tasks = \App\Models\Task::where('show', 1)->orderBy('sort')->get();
        // $this->users = \App\Models\User::orderBy('first_name')->get();

        $is_admin = $this->user->hasRole('owner') || $this->user->hasRole('manager');

        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'task_id' => $the_task ? false : true,
            'user_id' => true,
            'percentage' => true,
            'rate_text' => $is_admin ? true : false,
            'rate_val' => $is_admin ? true : false,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $completepercentage_id, $task_id, $user_id, $percentage, $rate_text, $rate_val;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        if (!$this->the_task)
            $this->task_id = null;

        $this->user_id = null;
        $this->percentage = '';
        $this->rate_text = '';
        $this->rate_val = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            // 'task_id' => 'required',
            // 'user_id' => 'required',
            'percentage' => 'required|integer|between:1,100',
            // 'rate_text' => 'required',
            // 'rate_val' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        CompletePercentage::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'task_id' => $this->task_id,
            // 'user_id' => $this->user_id,
            'user_id' => $this->user->id,
            'percentage' => $this->percentage,
            'rate_text' => $this->rate_text,
            'rate_val' => $this->rate_val,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $completepercentage = CompletePercentage::find($id);
        $this->completepercentage = $completepercentage;
        $this->completepercentage_id = $id;
        $this->slug = $completepercentage->slug;


        $this->task_id = $completepercentage->task_id;
        $this->user_id = $completepercentage->user_id;
        $this->percentage = $completepercentage->percentage;
        $this->rate_text = $completepercentage->rate_text;
        $this->rate_val = $completepercentage->rate_val;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->completepercentage_id) {
            $completepercentage = CompletePercentage::find($this->completepercentage_id);
            $completepercentage->update([
                'slug' => $this->slug,

                // 'task_id' => $this->task_id,
                // 'user_id' => $this->user_id,
                'percentage' => $this->percentage,
                'rate_text' => $this->rate_text,
                'rate_val' => $this->rate_val,
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
            $completepercentage = CompletePercentage::find($id);

            $completepercentage->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $completepercentage = CompletePercentage::withTrashed()->find($id);

            $completepercentage->restore();

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
        $completepercentages = CompletePercentage::livewireSearch($this->search);

        if ($this->all == false)
            $completepercentages = $completepercentages->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->the_task)
            $completepercentages = $completepercentages->where('task_id', $this->the_task->id);

        if ($this->filter_tasks_id)
            $completepercentages = $completepercentages->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_users_id)
            $completepercentages = $completepercentages->whereIn('user_id', $this->filter_users_id);


        if ($this->admin_view_status == 'deleted')
            $completepercentages = $completepercentages->onlyTrashed();


        $completepercentages = $completepercentages->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.completepercentage.completepercentage-index', compact('completepercentages'));
    }
}
