<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Branch;
use Livewire\Component;

class DashboardAddBranch extends Component
{
    public $areas = [];
    public $managers = [];
    public $responsibles = [];

    public $name, $location,
        $phone, $number,
        $fax, $email, $password,
        $website, $commercial_register,
        $area_id, $manager_id, $responsible_id;

    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        $this->areas = \App\Models\Area::where('show', 1)->orderBy('sort')->get();
        $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
        $this->responsibles = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
    }

    private function resetInputFields()
    {
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

        $this->get_create_date();
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

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-branch');
    }
}
