<?php

namespace App\Http\Livewire\Department;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentIndex extends Component
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

    public $selectedDepartments = [];

    public Department $department;
    private $departments;
    public $user;


    public $branches = [];

    public $managers = [];

    public $main_departments = [];

    public $the_manager;
    public $the_branch;

    public $filter_branches_id = [];

    public $filter_managers_id = [];

    public $filter_main_departments_id = [];

    public $selectedManagerD = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_manager = null, $the_branch = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->department = new Department();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');

        if (!$this->user->hasRole('owner')) {
            $the_manager = $this->user;
        }

        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();

        if ($the_manager) {
            $this->the_manager = $the_manager;
            $this->manager_id = $the_manager->id;

            // $this->managers = collect([$the_manager]);
        }

        $this->branches = \App\Models\Branch::where('show', 1)->orderBy('sort')->get();
        if ($the_branch) {
            $this->the_branch = $the_branch;
            $this->branch_id = $the_branch->id;

            // $this->branches = collect([$the_branch]);
        }

        $this->main_departments = \App\Models\Department::whereNullOrEmptyOrZero('main_department_id')->where('show', 1)->orderBy('sort')->get();

        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'name' => true,
            'branch_id' => !$this->the_branch ? true : false,
            'area_id' => true,
            'manager_id' => !$this->the_manager ? true : false,
            'main_department_id' => true,
            'employee' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $department_id, $branch_id, $manager_id, $main_department_id, $name;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        if (!$this->the_branch)
            $this->branch_id = null;

        if (!$this->the_manager)
            $this->manager_id = null;

        $this->main_department_id = null;

        $this->name = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'name' => 'required',
            'branch_id' => 'required',
            // 'manager_id' => 'required',
            // 'main_department_id' => 'required',

            'selectedManagerD' => 'required|array|min:1',
            'selectedManagerD.*' => 'integer|exists:users,id',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Department::create([
        //     'add_by' => $this->by->id,
        //     'slug' => $this->slug,

        //     'branch_id' => $this->branch_id,
        //     'manager_id' => $this->manager_id,
        //     'main_department_id' => $this->main_department_id,

        //     'name' => $this->name,
        // ]);

        foreach ($this->selectedManagerD as $managrId) {
            Department::create([
                'add_by' => $this->by->id,
                'slug' => $this->slug,
                'branch_id' => $this->branch_id,
                'manager_id' => $managrId,
                'main_department_id' => $this->main_department_id,
                'name' => $this->name,
            ]);
        }


        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $department = Department::find($id);
        $this->department = $department;
        $this->department_id = $id;
        $this->slug = $department->slug;


        $this->branch_id = $department->branch_id;
        $this->manager_id = $department->manager_id;
        $this->name = $department->name;

        $this->main_department_id = $department->main_department_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->department_id) {
            $department = Department::find($this->department_id);
            $department->update([
                'slug' => $this->slug,

                'name' => $this->name,

                'branch_id' => $this->branch_id,
                'manager_id' => $this->manager_id,
                'main_department_id' => $this->main_department_id,

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
            $department = Department::find($id);

            $department->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $department = Department::withTrashed()->find($id);

            $department->restore();

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


        $this->filter_branches_id = [];

        $this->filter_managers_id = [];

        $this->filter_main_departments_id = [];

        $this->select_branch = '';
        $this->select_manager = '';
    }


    public $select_branch;
    public function updatedSelectBranch($val)
    {
        $this->filter_branches_id[] = $val;
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
    }

    public $select_main_department;
    public function updatedSelectMainDepartment($val)
    {
        $this->filter_main_departments_id[] = $val;
    }

    public function updatedBranchId($val)
    {
        $branch = Branch::find($this->branch_id);

        $this->main_departments = Department::whereNullOrEmptyOrZero('main_department_id')->where('branch_id', $this->branch_id)->get();

        // if ($branch)
        //     $this->managers = $branch->managers;
        // else
        //     $this->managers = \App\Models\User::whereRoleIs('manager')->orderBy('first_name')->get();
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
        $departments = Department::livewireSearch($this->search);

        if ($this->all == false)
            $departments = $departments->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);


        if ($this->the_manager)
            $departments = $departments->where('manager_id', $this->the_manager->id);
        if ($this->the_branch)
            $departments = $departments->where('branch_id', $this->the_branch->id);


        if ($this->filter_branches_id)
            $departments = $departments->whereIn('branch_id', $this->filter_branches_id);

        if ($this->filter_managers_id)
            $departments = $departments->whereIn('manager_id', $this->filter_managers_id);

        if ($this->filter_main_departments_id)
            $departments = $departments->whereIn('main_department_id', $this->filter_main_departments_id);

        if ($this->admin_view_status == 'deleted')
            $departments = $departments->onlyTrashed();


        $departments = $departments->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.department.department-index', compact('departments'));
    }
}
