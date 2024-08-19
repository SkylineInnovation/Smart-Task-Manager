<?php

namespace App\Http\Livewire\Web;

use App\Mail\Task\SendNewTaskToEmployee;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class WebCreateNewTask extends Component
{
    public Task $task;
    public $user;

    public $employees = [];
    public $selectedEmployees = [];

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->task = new Task();

        $this->start_time = date('Y-m-d\Th:i');
        $this->end_time = date('Y-m-d\Th:i', strtotime('+1 Hours'));


        // $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();
        if ($this->user->hasRole('owner')) {
            $this->employees = \App\Models\User::orderBy('first_name')->get();
        } else {
            $this->employees = $this->user->employees;
        }

        // $this->employees = \App\Models\User::whereHas('employees', function ($q) {
        //     return $q->where('manager_id', $this->user->id);
        // })->orderBy('first_name')->get();
    }

    public $slug;
    public $discount = 0;
    public $task_id, $manager_id, $title, $desc,
        $start_time, $end_time,
        $priority_level = 'low', $status = 'pending';

    private function resetInputFields()
    {
        $this->slug = '';

        $this->manager_id = null;
        $this->title = '';
        $this->desc = '';
        $this->start_time = date('Y-m-d\Th:i');
        $this->end_time = date('Y-m-d\Th:i', strtotime('+1 Hours'));
        // $this->priority_level = 'low';
        // $this->status = 'pending';
        $this->discount = 0;

        $this->selectedEmployees = [];
    }

    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'priority_level' => 'required',
            'status' => 'required',
            'discount' => 'required',

            'selectedEmployees' => 'required',
        ];
    }

    protected $messages = [
        'selectedEmployees.required' => 'Please Select Employee',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $task = Task::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'manager_id' => $this->by->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'priority_level' => $this->priority_level,
            'status' => $this->status,
            // 'main_task_id' => $this->main_task_id,
        ]);

        $task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->discount]);

        if (env('SEND_MAIL', false))
            Mail::to(
                $task->employees->pluck('email')->toArray()
            )->send(new SendNewTaskToEmployee($task));

        session()->flash('message', 'Task Created Successfully.');

        $this->resetInputFields();

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

    public function render()
    {
        return view('livewire.web.web-create-new-task');
    }
}
