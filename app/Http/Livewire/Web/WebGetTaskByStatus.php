<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\HomeController;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebGetTaskByStatus extends Component
{
    use WithFileUploads;

    public $status;

    public $admin_view_status = '', $by, $url;
    public function mount($status, $admin_view_status = '',)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->status = $status;
    }

    public $task_id = 0;
    public function setTask($id)
    {
        $this->tab = 1;
        $this->task_id = $id;
    }

    public function startWithTask()
    {
        $task = Task::find($this->task_id);

        $task->update([
            'status' => 'active',
        ]);
    }

    public function finishWithTask()
    {
        $task = Task::find($this->task_id);

        $task->update([
            'status' => 'manual-finished',
        ]);
    }

    public $attatchment_file, $attatchment_title, $attatchment_desc;
    public function addAttatchment()
    {
        Attachment::create([
            'add_by' => $this->by->id,

            'user_id' => $this->by->id,
            'task_id' => $this->task_id,
            'title' => $this->attatchment_title,
            'desc' => $this->attatchment_desc,
            'file' => HomeController::saveImageWeb($this->attatchment_file, 'attachment'),
        ]);

        $this->attatchment_title = '';
        $this->attatchment_desc = '';
        $this->attatchment_file = null;
    }


    public $comment_title, $comment_desc;
    public function addComment()
    {
        Comment::create([
            'add_by' => $this->by->id,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->comment_title,
            'desc' => $this->comment_desc,
            // 'replay_time' => $this->replay_time,
            // 'main_comment_id' => $this->main_comment_id,
        ]);

        $this->comment_title = '';
        $this->comment_desc = '';
    }


    public $tab = 1;
    public function changeTab($index)
    {
        $this->tab = $index;
    }

    public function deleteAttatchment($id)
    {
        $attche = Attachment::find($id);
        $attche->delete();
    }

    public function deletecomment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    public function render()
    {
        $tasks = Task::where('status', $this->status);

        $tasks = $tasks->orderBy('id', 'desc')
            ->get();

        return view('livewire.web.web-get-task-by-status', compact('tasks'));
    }
}
