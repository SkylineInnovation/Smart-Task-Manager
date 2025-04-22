<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Department;
use App\Models\Work;
use Livewire\Component;

class DashboardAddWork extends Component
{
    public $branchs = [];
    public $departments = [];
    public $users = [];

    public $branch_id, $department_id, $user_id, $job_title;


    public $selectedusers = [];
    public $selectedDepart = [];

    public function mount()
    {
        $this->get_create_date();

        $this->departments = Department::orderBy('id', 'desc')->get();
    }

    public function get_create_date()
    {
        $this->branchs = \App\Models\Branch::where('show', 1)->orderBy('sort')->get();
        // $this->departments = \App\Models\Department::where('show', 1)->orderBy('sort')->get();
        $this->users = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
    }

    private function resetInputFields()
    {
        $this->branch_id = null;
        $this->department_id = null;
        $this->user_id = null;
        $this->job_title = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            // 'branch_id' => 'required',
            // 'department_id' => 'required',
            // 'user_id' => 'required',


            'job_title' => 'required',

            'selectedusers' => 'required|array|min:1',
            'selectedusers.*' => 'integer|exists:users,id',
            'selectedDepart' => 'required|array|min:1',
            'selectedDepart.*' => 'integer|exists:users,id',
        ];
    }

    public function updatedBranchId()
    {
        // $this->departments = \App\Models\Department::where('branch_id', $this->branch_id)
        //     ->where('show', 1)->orderBy('sort')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Work::create([
        //     'department_id' => $this->department_id,
        //     'user_id' => $this->user_id,
        //     'job_title' => $this->job_title,
        // ]);

        foreach ($this->selectedusers as $userId) {

            foreach ($this->selectedDepart as $depId) {
                Work::create([
                    'department_id' => $depId,
                    'user_id' => $userId,
                    'job_title' => $this->job_title,
                ]);
            }
        }

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-work');
    }
}
