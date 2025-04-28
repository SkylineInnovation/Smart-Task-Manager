<?php

namespace App\Http\Livewire\Dashboard;

use App\Jobs\SendNewTask;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DashboardAddTask extends Component
{
    public Task $task;
    public $user;

    public $employees;
    public $selectedEmployees = [];

    public $departments;
    public $selectedDepartments = [];

    public $branchs;
    public $selectedBranchs = [];


    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->get_create_date();
    }

    public $slug;
    public $discount = 0, $max_worning_discount = 0;
    public $task_id, $manager_id, $title, $desc,
        $start_time, $end_time,
        $comment_type = 'daily', $is_separate_task = 0, $max_worning_count = 0,
        $priority_level = 'low', $status = 'pending';

    public function get_create_date()
    {
        $this->task = new Task();

        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));


        if ($this->user->hasRole('owner')) {
            $this->employees = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
        } elseif ($this->user->hasRole('employee')) {
            $this->employees = User::where('id', $this->user->id)->get();
            $this->selectedEmployees = $this->employees->pluck('id')->toArray();
        } else {
            $this->employees = $this->user->employees;
        }

        $this->departments = Department::get();
        $this->branchs = Branch::get();

        // $this->employees = \App\Models\User::whereHas('employees', function ($q) {
        //     return $q->where('manager_id', $this->user->id);
        // })->orderBy('first_name')->get();
    }

    private function resetInputFields()
    {
        $this->slug = '';

        $this->manager_id = null;
        $this->title = '';
        $this->desc = '';
        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        // $this->priority_level = 'low';
        // $this->status = 'pending';
        $this->discount = 0;
        $this->max_worning_discount = 0;

        if (!$this->user->hasRole('employee'))
            $this->selectedEmployees = [];


        $this->selectedDepartments = [];
        $this->selectedBranchs = [];

        $this->comment_type = 'daily';
        $this->is_separate_task = 0;
        $this->max_worning_count = 0;

        $this->select_emp = '';
    }

    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'start_time' => 'required|date|after:' . date('Y-m-d\TH:i', strtotime('-5 Minutes')),
            'end_time' => 'required|date|after:start_time', // _or_equal
            'priority_level' => 'required',
            'status' => 'required',
            'is_separate_task' => 'required',
            'comment_type' => 'required',
            'max_worning_count' => 'required',
            'discount' => 'required',
            // 'max_worning_discount' => 'required',

            // 'selectedEmployees' => 'required',
        ];
    }

    protected $messages = [
        'selectedEmployees.required' => 'Please Select Employee',
        // 'selectedDepartments.required' => 'Please Select Department',
        // 'selectedBranchs.required' => 'Please Select Branch',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->is_separate_task) {
            foreach ($this->selectedEmployees as $selectedEmployee) {
                $task = Task::create([
                    'add_by' => $this->by->id,
                    'slug' => $this->slug,

                    'manager_id' => $this->by->id,
                    'title' => $this->title,
                    'desc' => $this->desc,
                    'start_time' => $this->start_time,
                    'end_time' => $this->end_time,
                    'is_separate_task' => $this->is_separate_task,
                    'comment_type' => $this->comment_type,
                    'max_worning_count' => $this->max_worning_count,
                    'priority_level' => $this->priority_level,
                    'status' => $this->status,
                    // 'main_task_id' => $this->main_task_id,
                ]);

                $task->employees()->syncWithPivotValues([$selectedEmployee], [
                    'discount' => $this->discount,
                    'max_worning_discount' => $this->max_worning_discount,
                ]);

                if (env('SEND_MAIL', false))
                    SendNewTask::dispatch($task);
            }
        } else {
            $task = Task::create([
                'add_by' => $this->by->id,
                'slug' => $this->slug,

                'manager_id' => $this->by->id,
                'title' => $this->title,
                'desc' => $this->desc,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'is_separate_task' => $this->is_separate_task,
                'comment_type' => $this->comment_type,
                'max_worning_count' => $this->max_worning_count,
                'priority_level' => $this->priority_level,
                'status' => $this->status,
                // 'main_task_id' => $this->main_task_id,
            ]);

            $task->employees()->syncWithPivotValues($this->selectedEmployees, [
                'discount' => $this->discount,
                'max_worning_discount' => $this->max_worning_discount,
            ]);

            if (env('SEND_MAIL', false))
                SendNewTask::dispatch($task);
        }


        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message        
        $this->emit('render-index'); // Close model to using to jquery
    }

    public function cancel()
    {
        $this->resetInputFields();
    }


    public $select_emp;
    public function updatedSelectEmp($val)
    {
        $this->selectedEmployees[] = $val;
    }

    public $select_branch;
    public function updatedSelectBranch($val)
    {
        if ($val == 0) {
            $this->selectedBranchs = [];
            $this->departments = Department::get();
        } else {
            $this->selectedBranchs[] = $val;
            $this->departments = Department::whereIn('branch_id', $this->selectedBranchs)->get();
        }
    }

    // public function updateSelectedBranchs()
    // {
    //     if ($this->selectedBranchs) {
    //         $this->departments = Department::whereIn('branch_id', $this->selectedBranchs)->get();
    //     } else {
    //         $this->departments = Department::get();
    //     }
    // }

    public $select_department;
    public function updatedSelectDepartment($val)
    {
        if ($val == 0) {
            $this->selectedDepartments = [];

            if ($this->user->hasRole('owner')) {
                $this->employees = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
            } elseif ($this->user->hasRole('employee')) {
                $this->employees = User::where('id', $this->user->id)->get();
                $this->selectedEmployees = $this->employees->pluck('id')->toArray();
            } else {
                $this->employees = $this->user->employees;
            }
        } else {
            $this->selectedDepartments[] = $val;

            $this->employees = User::whereHas('departments', function ($q) {
                $q->whereIn('id', $this->selectedDepartments);
            })->get();
        }
    }

    // public function updateSelectedDepartments()
    // {
    //     if ($this->selectedDepartments) {
    //         $this->employees = User::whereHas('departments', function ($q) {
    //             $q->whereIn('id', $this->selectedDepartments);
    //         })->get();
    //     } else {
    //         $this->employees = User::get();
    //     }
    // }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-task');
    }
}
