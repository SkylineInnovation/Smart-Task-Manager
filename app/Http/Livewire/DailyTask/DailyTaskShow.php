<?php

namespace App\Http\Livewire\Dailytask;

use App\Models\DailyTask;
use Livewire\Component;

class DailyTaskShow extends Component
{
    public DailyTask $dailytask;

    public $manager_id, $title, $description, $start_time, $end_time, $proearty = 'low', $status = 'pending', $repeat_time, $repeat_evrey;

    public $employees = [];
    public $selectedEmployees = [];

    public $discount;



    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            // 'manager_id' => 'required',
            'title' => 'required',
            // 'description' => 'required',
            // 'start_time' => 'required|date',
            'start_time' => 'required|date|after:' . date('Y-m-d\TH:i', strtotime('-5 Minutes')),
            'end_time' => 'required|date|after:start_time', // _or_equal
            'proearty' => 'required',
            'status' => 'required',
            'repeat_time' => 'required',
            // 'repeat_evrey' => 'required',

            'selectedEmployees' => 'required',

        ];
    }
    public function mount($dailytask)
    {
        $this->dailytask = $dailytask;

        $this->manager_id = $dailytask->manager_id;
        $this->title = $dailytask->title;
        $this->description = $dailytask->description;
        $this->start_time = $dailytask->start_time;
        $this->end_time = $dailytask->end_time;
        $this->proearty = $dailytask->proearty;
        $this->status = $dailytask->status;
        $this->repeat_time = $dailytask->repeat_time;
        $this->repeat_evrey = $dailytask->repeat_evrey;

        $this->selectedEmployees = $dailytask->employees->pluck('id')->toArray();

        $this->discount = $dailytask->discount();

        $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();
    }


    public function update()
    {
        $this->dailytask->update([
            // 'slug' => $this->slug,

            'manager_id' => $this->manager_id,
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'proearty' => $this->proearty,
            'status' => $this->status,
            'repeat_time' => $this->repeat_time,
            'repeat_evrey' => $this->repeat_evrey,
        ]);
        $this->dailytask->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->discount]);
    }
    public function render()
    {
        return view('livewire.dailytask.daily-task-show');
    }
}
