<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Component;

class TaskDetail extends Component
{
    public $rand;
    public Task $task;

    public $subRand;

    public function mount($task)
    {
        $this->rand = rand(10000, 99999);
        $this->subRand = rand(10000, 99999);

        $this->task = $task;
    }
    public function render()
    {

        return view('livewire.dashboard.task-detail');
    }
}
