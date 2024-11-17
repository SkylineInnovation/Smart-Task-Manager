<?php

namespace App\Http\Livewire\Work;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class WorkIndex extends Component
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

    public $selectedWorks = [];

    public Work $work;
    private $works;
    public $user;


    public $managers = [];

    public $departments = [];

    public $users = [];



    public $filter_managers_id = [];

    public $filter_departments_id = [];

    public $filter_users_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->work = new Work();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();

        $this->departments = \App\Models\Department::where('show', 1)->orderBy('sort')->get();

        $this->users = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'manager_id' => false,
            'department_id' => true,
            'user_id' => true,
            'job_title' => true,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $work_id, $manager_id, $department_id, $user_id, $job_title;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->manager_id = null;
        $this->department_id = null;
        $this->user_id = null;
        $this->job_title = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            // 'manager_id' => 'required',
            'department_id' => 'required',
            'user_id' => 'required',
            'job_title' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Work::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'manager_id' => $this->manager_id,
            'department_id' => $this->department_id,
            'user_id' => $this->user_id,
            'job_title' => $this->job_title,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $work = Work::find($id);
        $this->work = $work;
        $this->work_id = $id;
        $this->slug = $work->slug;


        $this->manager_id = $work->manager_id;
        $this->department_id = $work->department_id;
        $this->user_id = $work->user_id;
        $this->job_title = $work->job_title;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->work_id) {
            $work = Work::find($this->work_id);
            $work->update([
                'slug' => $this->slug,

                'manager_id' => $this->manager_id,
                'department_id' => $this->department_id,
                'user_id' => $this->user_id,
                'job_title' => $this->job_title,
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
            $work = Work::find($id);

            $work->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $work = Work::withTrashed()->find($id);

            $work->restore();

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


        $this->filter_managers_id = [];

        $this->filter_departments_id = [];

        $this->filter_users_id = [];
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
    }


    public $select_department;
    public function updatedSelectDepartment($val)
    {
        $this->filter_departments_id[] = $val;
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
        $works = Work::livewireSearch($this->search);

        if ($this->all == false)
            $works = $works->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_managers_id)
            $works = $works->whereIn('manager_id', $this->filter_managers_id);

        if ($this->filter_departments_id)
            $works = $works->whereIn('department_id', $this->filter_departments_id);

        if ($this->filter_users_id)
            $works = $works->whereIn('user_id', $this->filter_users_id);


        if ($this->admin_view_status == 'deleted')
            $works = $works->onlyTrashed();


        $works = $works->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.work.work-index', compact('works'));
    }
}
