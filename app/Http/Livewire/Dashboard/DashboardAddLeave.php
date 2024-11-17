<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardAddLeave extends Component
{
    public $leave_type,
        $leave_time_out, $leave_time_in,
        $leave_effect_on_time, $leave_reason, $leave_result;


    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        // $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
    }

    private function resetInputFields()
    {
        $this->leave_time_out = date('Y-m-d\TH:i');
        $this->leave_time_in = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->leave_effect_on_time = false;

        $this->leave_type = null;
        $this->leave_reason = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'leave_type' => 'required',
            'leave_time_out' => 'required',
            'leave_time_in' => 'required',
            'leave_reason' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Leave::create([
            // 'add_by' => $this->by->id,

            // 'task_id' => $this->task_id,
            'user_id' => Auth::user()->id,
            'type' => $this->leave_type,
            'time_out' => $this->leave_time_out,
            'time_in' => $this->leave_time_in,
            // 'effect_on_time' => $this->leave_effect_on_time,
            'reason' => $this->leave_reason,
            // 'result' => $this->leave_result,
            'status' => 'pending',
            // 'accepted_by_user_id' => $this->accepted_by_user_id,
            // 'accepted_time' => $this->accepted_time,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-leave');
    }
}
