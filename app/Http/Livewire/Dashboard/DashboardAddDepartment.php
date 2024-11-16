<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Department;
use Livewire\Component;

class DashboardAddDepartment extends Component
{
    public $branches = [];
    public $managers = [];

    public $branch_id, $manager_id, $name;

    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
        $this->branches = \App\Models\Branch::where('show', 1)->orderBy('sort')->get();
    }

    private function resetInputFields()
    {
        $this->name = '';

        $this->branch_id = null;
        $this->manager_id = null;

        $this->get_create_date();
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'name' => 'required',
            'branch_id' => 'required',
            'manager_id' => 'required',
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

            'branch_id' => $this->branch_id,
            'manager_id' => $this->manager_id,
            'name' => $this->name,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-department');
    }
}
