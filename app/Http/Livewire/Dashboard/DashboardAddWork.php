<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Work;
use Livewire\Component;

class DashboardAddWork extends Component
{
    public $departments = [];
    public $users = [];

    public $department_id, $user_id, $job_title;

    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        $this->departments = \App\Models\Department::where('show', 1)->orderBy('sort')->get();
        $this->users = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
    }

    private function resetInputFields()
    {
        $this->department_id = null;
        $this->user_id = null;
        $this->job_title = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


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
            'department_id' => $this->department_id,
            'user_id' => $this->user_id,
            'job_title' => $this->job_title,
        ]);

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
