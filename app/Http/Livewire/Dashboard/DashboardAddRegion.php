<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Area;
use Livewire\Component;

class DashboardAddRegion extends Component
{
    public $managers = [];

    public $name, $location, $manager_id;

    public $selectedManager = [];
    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->location = '';
        $this->manager_id = null;
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'name' => 'required',
            'location' => 'required',
            // 'manager_id' => 'required',

            'selectedManager' => 'required|array|min:1',
            'selectedManager.*' => 'integer|exists:users,id',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        // Area::create([
        //     'name' => $this->name,
        //     'location' => $this->location,
        //     'manager_id' => $this->manager_id,
        // ]);

        foreach ($this->selectedManager as $managrId) {
            Area::create([
                'name' => $this->name,
                'location' => $this->location,
                'manager_id' => $managrId,
            ]);
        }

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-region');
    }
}
