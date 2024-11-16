<?php

namespace App\Http\Livewire\Branch;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class BranchShow extends Component
{
    public Branch $branch;
    public $name, $location;
    public $managers = [];
    public $selectedManagers = [];

    public $url;
    public function mount($branch)
    {
        $this->url = Route::current()->getName();
        $this->branch = $branch;


        $this->name = $branch->name;
        $this->location = $branch->location;

        $this->selectedManagers = $branch->managers->pluck('id');
        $this->managers = User::whereRoleIs('manager')->get();
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

    public function update()
    {
        $this->branch->update([
            'name' => $this->name,
            'location' => $this->location,
        ]);

        $this->branch->managers()->sync($this->selectedManagers);

        session()->flash('message', __('global.updated-successfully'));
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.branch.branch-show');
    }
}
