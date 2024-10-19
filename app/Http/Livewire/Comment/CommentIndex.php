<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class CommentIndex extends Component
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

    public $selectedComments = [];

    public Comment $comment;
    private $comments;
    public $user;


    public $tasks = [];

    public $users = [];

    public $main_comments = [];



    public $filter_tasks_id = [];

    public $filter_users_id = [];

    public $filter_main_comments_id = [];

    public $the_user_id;
    public $the_task_id;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $user_id = null, $task_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->comment = new Comment();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');


        if ($user_id) {
            $this->user_id = $user_id;
            $this->the_user_id = $user_id;
        }

        if ($task_id) {
            $this->task_id = $task_id;
            $this->the_task_id = $task_id;
        }

        $this->tasks = \App\Models\Task::whereNullOrEmptyOrZero('main_task_id')->where('show', 1)->orderBy('sort')->get();

        $this->users = \App\Models\User::whereRoleIs('employee|manager')->orderBy('first_name')->get();


        $this->main_comments = \App\Models\Comment::whereNullOrEmptyOrZero('main_comment_id')->where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'task_id' => true,
            'user_id' => true,
            'title' => true,
            'desc' => false,
            'replay_time' => false,
            'main_comment_id' => true,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $comment_id, $task_id, $user_id, $title, $desc, $replay_time, $main_comment_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->task_id = null;
        // $this->user_id = null;
        $this->title = '';
        $this->desc = '';
        $this->replay_time = '';
        $this->main_comment_id = null;
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'task_id' => 'required',
            // 'user_id' => 'required',
            'title' => 'required',
            // 'desc' => 'required',
            // 'replay_time' => 'required',
            // 'main_comment_id' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Comment::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'task_id' => $this->task_id,
            'user_id' => $this->by->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'replay_time' => $this->replay_time,
            'main_comment_id' => $this->main_comment_id,
        ]);

        session()->flash('message', 'Comment Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $comment = Comment::find($id);
        $this->comment = $comment;
        $this->comment_id = $id;
        $this->slug = $comment->slug;


        $this->task_id = $comment->task_id;
        $this->user_id = $comment->user_id;
        $this->title = $comment->title;
        $this->desc = $comment->desc;
        $this->replay_time = $comment->replay_time;
        $this->main_comment_id = $comment->main_comment_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->comment_id) {
            $comment = Comment::find($this->comment_id);
            $comment->update([
                'slug' => $this->slug,

                // 'task_id' => $this->task_id,
                // 'user_id' => $this->user_id,
                'title' => $this->title,
                'desc' => $this->desc,
                'replay_time' => $this->replay_time,
                'main_comment_id' => $this->main_comment_id,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Comment Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $comment = Comment::find($id);

            $comment->delete();

            session()->flash('message', 'Comment Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $comment = Comment::withTrashed()->find($id);

            $comment->restore();

            session()->flash('message', 'Comment Recovered Successfully.');
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


        $this->filter_tasks_id = [];

        $this->filter_users_id = [];

        $this->filter_main_comments_id = [];
    }


    public $select_task;
    public function updatedSelectTask($val)
    {
        $this->filter_tasks_id[] = $val;
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
    }


    public $select_main_comment;
    public function updatedSelectMain_comment($val)
    {
        $this->filter_main_comments_id[] = $val;
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
        $comments = Comment::livewireSearch($this->search);

        if ($this->all == false)
            $comments = $comments->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_tasks_id)
            $comments = $comments->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_users_id)
            $comments = $comments->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_main_comments_id)
            $comments = $comments->whereIn('main_comment_id', $this->filter_main_comments_id);

        if ($this->the_user_id)
            $comments = $comments->where('user_id', $this->the_user_id);
        if ($this->the_task_id)
            $comments = $comments->where('task_id', $this->the_task_id);


        if ($this->admin_view_status == 'deleted')
            $comments = $comments->onlyTrashed();


        $comments = $comments->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.comment.comment-index', compact('comments'));
    }
}
