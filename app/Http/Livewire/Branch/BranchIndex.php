<?php

namespace App\Http\Livewire\Branch;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class BranchIndex extends Component
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

    public $selectedBranches = [];

    public Branch $branch;
    private $branches;
    public $user;


    public $areas = [];
    public $managers = [];
    public $responsibles = [];

    public $filter_areas_id = [];
    public $filter_managers_id = [];
    public $filter_responsibles_id = [];

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->branch = new Branch();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->areas = \App\Models\Area::where('show', 1)->orderBy('sort')->get();

        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();

        $this->responsibles = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'name' => true,
            'location' => false,
            'phone' => false,
            'number' => false,
            'fax' => false,
            'email' => false,
            'password' => false,
            'website' => false,
            'commercial_register' => false,
            'area_id' => true,
            'manager_id' => true,
            'responsible_id' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $branch_id, $name, $location, $phone, $number, $fax, $email, $password, $website, $commercial_register, $area_id, $manager_id, $responsible_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->name = '';
        $this->location = '';
        $this->phone = '';
        $this->number = '';
        $this->fax = '';
        $this->email = '';
        $this->password = '';
        $this->website = '';
        $this->commercial_register = '';
        $this->area_id = null;
        $this->manager_id = null;
        $this->responsible_id = null;
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'name' => 'required',
            'location' => 'required',
            'phone' => 'required',
            'number' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'password' => 'required',
            'website' => 'required',
            'commercial_register' => 'required',
            'area_id' => 'required',

            'manager_id' => 'required',
            'responsible_id' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Branch::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'name' => $this->name,
            'location' => $this->location,
            'phone' => $this->phone,
            'number' => $this->number,
            'fax' => $this->fax,
            'email' => $this->email,
            'password' => $this->password,
            'website' => $this->website,
            'commercial_register' => $this->commercial_register,
            'area_id' => $this->area_id,
            'manager_id' => $this->manager_id,
            'responsible_id' => $this->responsible_id,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $branch = Branch::find($id);
        $this->branch = $branch;
        $this->branch_id = $id;
        $this->slug = $branch->slug;


        $this->name = $branch->name;
        $this->location = $branch->location;
        $this->phone = $branch->phone;
        $this->number = $branch->number;
        $this->fax = $branch->fax;
        $this->email = $branch->email;
        $this->password = $branch->password;
        $this->website = $branch->website;
        $this->commercial_register = $branch->commercial_register;
        $this->area_id = $branch->area_id;
        $this->manager_id = $branch->manager_id;
        $this->responsible_id = $branch->responsible_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->branch_id) {
            $branch = Branch::find($this->branch_id);
            $branch->update([
                'slug' => $this->slug,

                'name' => $this->name,
                'location' => $this->location,
                'phone' => $this->phone,
                'number' => $this->number,
                'fax' => $this->fax,
                'email' => $this->email,
                'password' => $this->password,
                'website' => $this->website,
                'commercial_register' => $this->commercial_register,
                'area_id' => $this->area_id,
                'manager_id' => $this->manager_id,
                'responsible_id' => $this->responsible_id,
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
            $branch = Branch::find($id);

            $branch->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $branch = Branch::withTrashed()->find($id);

            $branch->restore();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
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


        $this->filter_areas_id = [];

        $this->filter_managers_id = [];

        $this->filter_responsibles_id = [];
    }


    public $select_area;
    public function updatedSelectArea($val)
    {
        $this->filter_areas_id[] = $val;
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
    }


    public $select_responsible;
    public function updatedSelectResponsible($val)
    {
        $this->filter_responsibles_id[] = $val;
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
        $branches = Branch::livewireSearch($this->search);

        if ($this->all == false)
            $branches = $branches->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_areas_id)
            $branches = $branches->whereIn('area_id', $this->filter_areas_id);

        if ($this->filter_managers_id)
            $branches = $branches->whereIn('manager_id', $this->filter_managers_id);

        if ($this->filter_responsibles_id)
            $branches = $branches->whereIn('responsible_id', $this->filter_responsibles_id);


        if ($this->admin_view_status == 'deleted')
            $branches = $branches->onlyTrashed();


        $branches = $branches->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.branch.branch-index', compact('branches'));
    }
}
