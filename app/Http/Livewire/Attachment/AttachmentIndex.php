<?php

namespace App\Http\Livewire\Attachment;

use App\Http\Controllers\HomeController;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AttachmentIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

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

    public $selectedAttachments = [];

    public Attachment $attachment;
    private $attachments;
    public $user;


    public $users = [];

    public $tasks = [];

    public $main_attachments = [];



    public $filter_users_id = [];

    public $filter_tasks_id = [];

    public $filter_main_attachments_id = [];

    public $the_user_id;
    public $the_task_id;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $user_id = null, $task_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->attachment = new Attachment();

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



        $this->users = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();

        $this->tasks = \App\Models\Task::whereNullOrEmptyOrZero('main_task_id')->where('show', 1)->orderBy('sort')->get();

        $this->main_attachments = \App\Models\Attachment::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'task_id' => true,
            'title' => true,
            'desc' => false,
            'file' => true,
            'main_attachment_id' => false,

            // 'status' => false,
            'date' => false,
            'time' => false,
        ]);
    }

    public $slug;
    public $attachment_id, $user_id, $task_id, $title, $desc, $file, $main_attachment_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->user_id = null;
        // $this->task_id = null;
        $this->title = '';
        $this->desc = '';
        $this->file = '';
        $this->main_attachment_id = null;
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            // 'user_id' => 'required',
            'task_id' => 'required',
            // 'title' => 'required',
            // 'desc' => 'required',
            'file' => 'required',
            // 'main_attachment_id' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Attachment::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'user_id' => $this->by->id,
            'task_id' => $this->task_id,
            'title' => $this->title,
            'desc' => $this->desc,
            // 'file' => $this->file,
            'file' => HomeController::saveImageWeb($this->file, 'attachment'),
            'main_attachment_id' => $this->main_attachment_id,
        ]);

        session()->flash('message', 'Attachment Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $attachment = Attachment::find($id);
        $this->attachment = $attachment;
        $this->attachment_id = $id;
        $this->slug = $attachment->slug;


        $this->user_id = $attachment->user_id;
        $this->task_id = $attachment->task_id;
        $this->title = $attachment->title;
        $this->desc = $attachment->desc;
        // $this->file = $attachment->file;
        $this->main_attachment_id = $attachment->main_attachment_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->attachment_id) {
            $attachment = Attachment::find($this->attachment_id);
            $attachment->update([
                'slug' => $this->slug,
                // 'user_id' => $this->user_id,
                'task_id' => $this->task_id,
                'title' => $this->title,
                'desc' => $this->desc,
                'file' => $this->file ? HomeController::saveImageWeb($this->file, 'attachment') : $attachment->file,
                'main_attachment_id' => $this->main_attachment_id,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Attachment Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $attachment = Attachment::find($id);

            $attachment->delete();

            session()->flash('message', 'Attachment Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $attachment = Attachment::withTrashed()->find($id);

            $attachment->restore();

            session()->flash('message', 'Attachment Recovered Successfully.');
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


        $this->filter_users_id = [];

        $this->filter_tasks_id = [];

        $this->filter_main_attachments_id = [];
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
    }


    public $select_task;
    public function updatedSelectTask($val)
    {
        $this->filter_tasks_id[] = $val;
    }


    public $select_main_attachment;
    public function updatedSelectMain_attachment($val)
    {
        $this->filter_main_attachments_id[] = $val;
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
        $attachments = Attachment::livewireSearch($this->search);

        if ($this->all == false)
            $attachments = $attachments->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $attachments = $attachments->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_tasks_id)
            $attachments = $attachments->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_main_attachments_id)
            $attachments = $attachments->whereIn('main_attachment_id', $this->filter_main_attachments_id);


        if ($this->the_user_id)
            $attachments = $attachments->where('user_id', $this->the_user_id);

        if ($this->the_task_id)
            $attachments = $attachments->where('task_id', $this->the_task_id);

        if ($this->admin_view_status == 'deleted')
            $attachments = $attachments->onlyTrashed();


        $attachments = $attachments->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.attachment.attachment-index', compact('attachments'));
    }
}
