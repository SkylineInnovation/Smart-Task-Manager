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

    public $the_manager;
    public $the_branch;

    public $filter_branches_id = [];

    public $filter_managers_id = [];



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

        if ($the_manager) {
            $this->the_manager = $the_manager;
            $this->manager_id = $the_manager->id;

            $this->managers = collect([$the_manager]);
        } else {
            $this->managers = \App\Models\User::whereRoleIs('manager')->orderBy('first_name')->get();
        }

        if ($the_branch) {
            $this->the_branch = $the_branch;
            $this->branch_id = $the_branch->id;

            $this->branches = collect([$the_branch]);
        } else {
            $this->branches = \App\Models\Branch::where('show', 1)->orderBy('sort')->get();
        }



        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'branch_id' => !$this->the_branch ? true : false,
            'manager_id' => !$this->the_manager ? true : false,
            'name' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $department_id, $branch_id, $manager_id, $name;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        if (!$this->the_branch)
            $this->branch_id = null;

        if (!$this->the_manager)
            $this->manager_id = null;
        $this->name = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'branch_id' => 'required',
            'manager_id' => 'required',
            'name' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Department::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'branch_id' => $this->branch_id,
            'manager_id' => $this->manager_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Department Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
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

                'branch_id' => $this->branch_id,
                'manager_id' => $this->manager_id,
                'name' => $this->name,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Department Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $department = Department::find($id);

            $department->delete();

            session()->flash('message', 'Department Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $department = Department::withTrashed()->find($id);

            $department->restore();

            session()->flash('message', 'Department Recovered Successfully.');
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

    public function updatedBranchId($val)
    {
        $branch = Branch::find($this->branch_id);

        if ($branch)
            $this->managers = $branch->managers;
        else
            $this->managers = \App\Models\User::whereRoleIs('manager')->orderBy('first_name')->get();
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


        if ($this->admin_view_status == 'deleted')
            $departments = $departments->onlyTrashed();


        $departments = $departments->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.department.department-index', compact('departments'));
    }
}
