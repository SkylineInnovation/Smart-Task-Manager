<?php

namespace App\Http\Livewire\Task;

use App\Jobs\SendNewTask;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
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

    public $dailytask;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_manager_id = null, $the_employee_id = null, $dailytask = null)
    {
        // $this->numberOfPaginatorsRendered = 5;
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->task = new Task();

        $this->dailytask = $dailytask;

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');

        if ($the_manager_id)
            $this->the_manager_id = $the_manager_id;

        if ($the_employee_id)
            $this->the_employee_id = $the_employee_id;

        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        if ($this->user->hasRole('owner')) {
            $this->employees = \App\Models\User::whereRoleIs('manager')->orWhereRoleIs('employee')->orderBy('first_name')->get();
        } else {
            $this->employees = $this->user->employees;
        }


        $this->showColumn = collect([
            'id' => true,
            'slug' => false,


            'manager_id' => true,
            'employees' => true,
            'title' => true,
            'desc' => false,
            'start_time' => true,
            'end_time' => true,
            'is_separate_task' => false,
            'comment_type' => true,
            'max_worning_count' => true,
            'priority_level' => true,
            'status' => true,
            'main_task_id' => false,


            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $task_id, $manager_id, $title, $desc, $start_time, $end_time, $is_separate_task = 0, $comment_type = 'daily', $max_worning_count, $priority_level = 'low', $status = 'pending', $main_task_id, $daily_task_id;

    public $task_status = 'all';
    public $discount = 0, $max_worning_discount = 0;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->manager_id = null;
        $this->title = '';
        $this->desc = '';
        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));
        $this->is_separate_task = 0;
        $this->comment_type = 'daily';
        $this->max_worning_count = null;
        // $this->priority_level = 'low';
        // $this->status = 'pending';
        $this->main_task_id = null;
        $this->discount = 0;
        $this->max_worning_discount = 0;

        $this->reopen_from_task_id = 0;
        $this->daily_task_id = 0;

        $this->selectedEmployees = [];
    }


    public function rules()
    {
        return [
            // 'manager_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            // 'start_time' => 'required|date',
            'start_time' => 'required|date|after:' . date('Y-m-d\TH:i', strtotime('-5 Minutes')),
            'end_time' => 'required|date|after:start_time', // _or_equal
            'is_separate_task' => 'required',
            'comment_type' => 'required',
            'max_worning_count' => 'required',
            'priority_level' => 'required',
            'status' => 'required',
            'discount' => 'required',
            'max_worning_discount' => 'required',
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

    public function store($save_for_later = false)
    {
        if (!$save_for_later)
            $validatedData = $this->validate();


        if ($this->is_separate_task) {
            foreach ($this->selectedEmployees as $selectedEmployee) {
                $task = Task::create([
                    'add_by' => $this->by->id,
                    'slug' => $save_for_later ? 'archive' : $this->slug,

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
                    'main_task_id' => $this->main_task_id,
                    'reopen_from_task_id' => $this->reopen_from_task_id,
                    'daily_task_id' => $this->daily_task_id,
                ]);

                $task->employees()->syncWithPivotValues([$selectedEmployee], [
                    'discount' => $this->discount,
                    'max_worning_discount' => $this->max_worning_discount,
                ]);

                if (env('SEND_MAIL', false))
                    SendNewTask::dispatchAfterResponse($task);
            }
        } else {
            $task = Task::create([
                'add_by' => $this->by->id,
                'slug' => $save_for_later ? 'archive' : $this->slug,

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
                'main_task_id' => $this->main_task_id,
                'reopen_from_task_id' => $this->reopen_from_task_id,
                'daily_task_id' => $this->daily_task_id,
            ]);

            $task->employees()->syncWithPivotValues($this->selectedEmployees, [
                'discount' => $this->discount,
                'max_worning_discount' => $this->max_worning_discount
            ]);

            if (env('SEND_MAIL', false))
                SendNewTask::dispatchAfterResponse($task);
        }


        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message

        // if (env('SEND_MAIL', false))
        //     SendNewTask::dispatchAfterResponse($task);
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
        $this->is_separate_task = $task->is_separate_task;
        $this->comment_type = $task->comment_type;
        $this->max_worning_count = $task->max_worning_count;
        $this->priority_level = $task->priority_level;
        $this->status = $task->status;
        $this->main_task_id = $task->main_task_id;
        $this->reopen_from_task_id = $task->reopen_from_task_id;
        $this->daily_task_id = $task->daily_task_id;

        $this->selectedEmployees = $task->employees->pluck('id');

        $this->discount = $task->discount();
        $this->max_worning_discount = $task->max_worning_discount();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update($activate = false)
    {

        if ($this->task_id) {
            $task = Task::find($this->task_id);

            if (in_array($task->status, ['auto-finished', 'manual-finished'])) {

                session()->flash('message', __('global.task-cant-be-updated'));
                $this->emit('show-message', ['message' => __('global.task-cant-be-updated')]); // show toster message
                return;
            }

            $task->update([
                'slug' => $activate ? null : $this->slug,

                // 'manager_id' => $this->manager_id,
                'title' => $this->title,
                'desc' => $this->desc,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                // 'is_separate_task' => $this->is_separate_task,
                'comment_type' => $this->comment_type,
                'max_worning_count' => $this->max_worning_count,
                'priority_level' => $this->priority_level,
                'status' => $this->status,
                'main_task_id' => $this->main_task_id,
                'reopen_from_task_id' => $this->reopen_from_task_id,
                'daily_task_id' => $this->daily_task_id,
            ]);

            $task->employees()->syncWithPivotValues($this->selectedEmployees, [
                'discount' => $this->discount,
                'max_worning_discount' => $this->max_worning_discount
            ]);

            $this->updateMode = false;
            session()->flash('message', __('global.updated-successfully'));
            $this->resetInputFields();
            $this->emit('close-model'); // Close model to using to jquery
            $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
        }
    }

    public function delete($id)
    {
        if ($id) {
            $task = Task::find($id);

            $task->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $task = Task::withTrashed()->find($id);

            $task->restore();

            session()->flash('message', __('global.recovered-successfully'));
            $this->emit('show-message', ['message' => __('global.recovered-successfully')]); // show toster message
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

        $this->select_manager = '';
        $this->select_main_task = '';
    }


    public $select_manager;
    public function updatedSelectManager($val)
    {
        $this->filter_managers_id[] = $val;
    }


    public $select_main_task;
    public function updatedSelectMainTask($val)
    {
        $this->filter_main_tasks_id[] = $val;
    }

    public $reopen_from_task_id = 0;
    public function reopen_task($oldID)
    {
        $task = Task::find($oldID);

        $this->reopen_from_task_id = $oldID;

        $this->manager_id = $task->manager_id;
        $this->title = $task->title;
        $this->desc = $task->desc;

        $this->start_time = date('Y-m-d\TH:i');
        $this->end_time = date('Y-m-d\TH:i', strtotime('+1 Hours'));

        $this->selectedEmployees = [];

        $this->is_separate_task = $task->is_separate_task;
        $this->comment_type = $task->comment_type;
        $this->max_worning_count = $task->max_worning_count;
        $this->priority_level = $task->priority_level;
        $this->daily_task_id = $task->daily_task_id;
        $this->status = 'pending';
        $this->discount = $task->discount();
        $this->max_worning_discount = $task->max_worning_discount();
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

        $tasks = $tasks->whereNullOrEmptyOrZero('main_task_id');


        if ($this->task_status != 'all') {
            if (in_array($this->task_status, ['draft', 'archive'])) {
                $tasks = $tasks->where('slug', $this->task_status);
            } else {
                $tasks = $tasks->where('status', $this->task_status);
            }
        }

        if ($this->filter_managers_id)
            $tasks = $tasks->whereIn('manager_id', $this->filter_managers_id);

        if ($this->filter_main_tasks_id)
            $tasks = $tasks->whereIn('main_task_id', $this->filter_main_tasks_id);

        if ($this->the_manager_id)
            $tasks = $tasks->where('the_manager_id', $this->the_manager_id);

        if ($this->dailytask)
            $tasks = $tasks->where('daily_task_id', $this->dailytask->id);

        if ($this->the_employee_id)
            $tasks = $tasks->whereHas('employees', function ($q) {
                $q->where('user_id', $this->the_employee_id);
            });

        if ($this->user->hasRole('manager')) {
            $tasks = $tasks->orWhere('manager_id', $this->user->id);
        }

        if ($this->user->hasRole('employee')) {
            $tasks = $tasks->orWhereHas('employees', function ($q) {
                $q->where('user_id', $this->user->id);
            });
        }


        if ($this->admin_view_status == 'deleted')
            $tasks = $tasks->onlyTrashed();


        $tasks = $tasks->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.task.task-index', compact('tasks'));
    }
}
