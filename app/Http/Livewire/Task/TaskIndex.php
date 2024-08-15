<?php

namespace App\Http\Livewire\Task;

use App\Mail\Task\SendNewTaskToEmployee;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class TaskIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 25;
    public $search = '';
    public $orderBy = 'id';
    public $orderWay = 'desc';
    public $showColumn;

    public $all;
    public $fromDate = null;
    public $toDate = null;
    public $byDate = 'created_at';

    public $selectedTasks = [];

    public Task $task;
    private $tasks;
    public $user;


    public $managers = [];

    public $main_tasks = [];

    public $employees = [];
    public $selectedEmployees = [];


    public $filter_managers_id = [];

    public $filter_main_tasks_id = [];

    public $the_manager_id;
    public $the_employee_id;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_manager_id = null, $the_employee_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->task = new Task();


        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');

        if ($the_manager_id)
            $this->the_manager_id = $the_manager_id;
        if ($the_employee_id)
            $this->the_employee_id = $the_employee_id;

        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->employees = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();

        $this->main_tasks = \App\Models\Task::whereNullOrEmptyOrZero('main_task_id')->where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'manager_id' => true,
            'title' => true,
            'desc' => false,
            'start_time' => true,
            'end_time' => true,
            'priority_level' => true,
            'status' => true,
            'main_task_id' => false,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $task_id, $manager_id, $title, $desc, $start_time, $end_time, $priority_level = 'low', $status = 'pending', $main_task_id;
    public $discount = 0;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->manager_id = null;
        $this->title = '';
        $this->desc = '';
        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        // $this->priority_level = 'low';
        // $this->status = 'pending';
        $this->main_task_id = null;
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
            // 'main_task_id' => 'required',

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
            'main_task_id' => $this->main_task_id,
        ]);

        $task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->discount]);

        if (env('SEND_MAIL', false))
            Mail::to(
                $task->employees->pluck('email')->toArray()
            )->send(new SendNewTaskToEmployee($task));

        session()->flash('message', 'Task Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $task = Task::find($id);
        $this->task = $task;
        $this->task_id = $id;
        $this->slug = $task->slug;


        $this->manager_id = $task->manager_id;
        $this->title = $task->title;
        $this->desc = $task->desc;
        $this->start_time = $task->start_time;
        $this->end_time = $task->end_time;
        $this->priority_level = $task->priority_level;
        $this->status = $task->status;
        $this->main_task_id = $task->main_task_id;

        $this->selectedEmployees = $task->employees->pluck('id');

        $this->discount = $task->discount();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->task_id) {
            $task = Task::find($this->task_id);
            $task->update([
                'slug' => $this->slug,

                // 'manager_id' => $this->manager_id,
                'title' => $this->title,
                'desc' => $this->desc,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'priority_level' => $this->priority_level,
                'status' => $this->status,
                'main_task_id' => $this->main_task_id,
            ]);

            $task->employees()->syncWithPivotValues($this->selectedEmployees, ['discount' => $this->discount]);

            $this->updateMode = false;
            session()->flash('message', 'Task Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $task = Task::find($id);

            $task->delete();

            session()->flash('message', 'Task Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $task = Task::withTrashed()->find($id);

            $task->restore();

            session()->flash('message', 'Task Recovered Successfully.');
        }
    }

    public function updatedFromDate($fromDate)
    {
        $this->all = false;
    }

    public function updatedToDate($toDate)
    {
        $this->all = false;
    }

    public function clearFilter()
    {
        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->byDate = 'created_at';
        $this->fromDate = '';
        $this->toDate = date('Y-m-d');


        $this->filter_managers_id = [];

        $this->filter_main_tasks_id = [];
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
    }


    public $select_main_task;
    public function updatedSelectMain_task($val)
    {
        $this->filter_main_tasks_id[] = $val;
    }




    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }

    public function render()
    {
        $tasks = Task::livewireSearch($this->search);

        if ($this->all == false)
            $tasks = $tasks->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_managers_id)
            $tasks = $tasks->whereIn('manager_id', $this->filter_managers_id);

        if ($this->filter_main_tasks_id)
            $tasks = $tasks->whereIn('main_task_id', $this->filter_main_tasks_id);

        if ($this->the_manager_id)
            $tasks = $tasks->where('the_manager_id', $this->the_manager_id);

        if ($this->the_employee_id)
            $tasks = $tasks->whereHas('employees', function ($q) {
                $q->where('user_id', $this->the_employee_id);
            });


        if ($this->admin_view_status == 'deleted')
            $tasks = $tasks->onlyTrashed();


        $tasks = $tasks->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.task.task-index', compact('tasks'));
    }
}
