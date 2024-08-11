<?php

namespace App\Http\Livewire\Web\Task;

use App\Models\Task;
use Livewire\Component;

class TaskCreateModal extends Component
{

    public  $priority_level;

    public $users = [];

    public $selectedUsers = [];

    public $title = '';

    public $discount;

    public  $start_date = '';

    public $end_date = '';

    public $description = '';

    public $status = '';



    public function createTask()
    {

        dd([
            $this->selectedUsers,
            $this->title,
            $this->description,
            $this->start_date,
            $this->end_date,
            $this->priority_level,
        ]);

        $task = Task::create([
            'title'         => $this->title,
            'desc'          => $this->description,
            'start_time'    => $this->start_date,
            'end_time'      => $this->end_date,
            'status'        => 'pending',

            'add_by' => auth()->user()->id,
            'manager_id' => auth()->user()->id,
            'priority_level' => $this->priority_level,

        ]);

        session()->flash('message', 'Task Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function render()
    {
        return view('livewire.web.task.task-create-modal');
    }
}
