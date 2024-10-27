<?php

namespace App\Http\Livewire\Branch;

use App\Models\Branch;
use App\Models\User;
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


    public $managers = [];
    public $selectedManagers = [];


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


        $this->managers = User::whereRoleIs('manager')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'name' => true,
            'location' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $branch_id, $name, $location;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->name = '';
        $this->location = '';

        $this->selectedManagers = [];
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'name' => 'required',
            'location' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $branch = Branch::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'name' => $this->name,
            'location' => $this->location,
        ]);

        $branch->managers()->sync($this->selectedManagers);

        session()->flash('message', 'Branch Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
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

        $this->selectedManagers = $branch->managers->pluck('id');
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
            ]);

            $branch->managers()->sync($this->selectedManagers);


            $this->updateMode = false;
            session()->flash('message', 'Branch Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $branch = Branch::find($id);

            $branch->delete();

            session()->flash('message', 'Branch Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $branch = Branch::withTrashed()->find($id);

            $branch->restore();

            session()->flash('message', 'Branch Recovered Successfully.');
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




        if ($this->admin_view_status == 'deleted')
            $branches = $branches->onlyTrashed();


        $branches = $branches->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.branch.branch-index', compact('branches'));
    }
}
