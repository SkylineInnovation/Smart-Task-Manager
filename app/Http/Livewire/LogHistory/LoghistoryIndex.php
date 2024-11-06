<?php

namespace App\Http\Livewire\Loghistory;

use App\Models\LogHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class LoghistoryIndex extends Component
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

    public $selectedLogHistories = [];

    public LogHistory $loghistory;
    private $loghistories;
    public $user;


    public $users = [];

    public $the_user;

    public $filter_users_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_user = null, $by_model_name = null, $by_model_id = null, $on_model_name = null, $on_model_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->loghistory = new LogHistory();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');

        if ($the_user) {
            $this->the_user = $the_user;
            $this->user_id = $the_user->id;
        }

        if ($by_model_name)
            $this->by_model_name = $by_model_name;

        if ($by_model_id)
            $this->by_model_id = $by_model_id;

        if ($on_model_name)
            $this->on_model_name = $on_model_name;

        if ($on_model_id)
            $this->on_model_id = $on_model_id;


        $this->users = \App\Models\User::orderBy('id', 'desc')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'action' => true,
            'by_model_name' => false,
            'by_model_id' => false,
            'on_model_name' => false,
            'on_model_id' => false,
            'from_data' => false,
            'to_data' => false,
            'preaf' => true,
            'desc' => true,
            'color' => false,

            // 'status' => false,
            'date' => true,
            'time' => true,
        ]);
    }

    public $slug;
    public $loghistory_id, $user_id, $action, $by_model_name, $by_model_id, $on_model_name, $on_model_id, $from_data, $to_data, $preaf, $desc, $color;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = null;
        $this->action = '';
        // $this->by_model_name = '';
        // $this->by_model_id = 0;
        // $this->on_model_name = '';
        // $this->on_model_id = 0;
        $this->from_data = '';
        $this->to_data = '';
        $this->preaf = '';
        $this->desc = '';
        $this->color = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'action' => 'required',
            'by_model_name' => 'required',
            'by_model_id' => 'required',
            'on_model_name' => 'required',
            'on_model_id' => 'required',
            'from_data' => 'required',
            'to_data' => 'required',
            'preaf' => 'required',
            'desc' => 'required',
            'color' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        return;
        $validatedData = $this->validate();

        LogHistory::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'action' => $this->action,
            'by_model_name' => $this->by_model_name,
            'by_model_id' => $this->by_model_id,
            'on_model_name' => $this->on_model_name,
            'on_model_id' => $this->on_model_id,
            'from_data' => $this->from_data,
            'to_data' => $this->to_data,
            'preaf' => $this->preaf,
            'desc' => $this->desc,
            'color' => $this->color,
        ]);

        session()->flash('message', 'LogHistory Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        return;
        $this->updateMode = true;
        $loghistory = LogHistory::find($id);
        $this->loghistory = $loghistory;
        $this->loghistory_id = $id;
        $this->slug = $loghistory->slug;


        $this->user_id = $loghistory->user_id;
        $this->action = $loghistory->action;
        $this->by_model_name = $loghistory->by_model_name;
        $this->by_model_id = $loghistory->by_model_id;
        $this->on_model_name = $loghistory->on_model_name;
        $this->on_model_id = $loghistory->on_model_id;
        $this->from_data = $loghistory->from_data;
        $this->to_data = $loghistory->to_data;
        $this->preaf = $loghistory->preaf;
        $this->desc = $loghistory->desc;
        $this->color = $loghistory->color;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        return;
        if ($this->loghistory_id) {
            $loghistory = LogHistory::find($this->loghistory_id);
            $loghistory->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'action' => $this->action,
                'by_model_name' => $this->by_model_name,
                'by_model_id' => $this->by_model_id,
                'on_model_name' => $this->on_model_name,
                'on_model_id' => $this->on_model_id,
                'from_data' => $this->from_data,
                'to_data' => $this->to_data,
                'preaf' => $this->preaf,
                'desc' => $this->desc,
                'color' => $this->color,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'LogHistory Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        return;
        if ($id) {
            $loghistory = LogHistory::find($id);

            $loghistory->delete();

            session()->flash('message', 'LogHistory Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $loghistory = LogHistory::withTrashed()->find($id);

            $loghistory->restore();

            session()->flash('message', 'LogHistory Recovered Successfully.');
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

        $this->select_user = '';
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
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
        $loghistories = LogHistory::livewireSearch($this->search);

        if ($this->all == false)
            $loghistories = $loghistories->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->the_user)
            $loghistories = $loghistories->where('user_id', $this->the_user->id);

        if ($this->filter_users_id)
            $loghistories = $loghistories->whereIn('user_id', $this->filter_users_id);

        if ($this->by_model_name)
            $loghistories = $loghistories->where('by_model_name', $this->by_model_name);

        if ($this->by_model_id)
            $loghistories = $loghistories->where('by_model_id', $this->by_model_id);

        if ($this->on_model_name)
            $loghistories = $loghistories->where('on_model_name', $this->on_model_name);

        if ($this->on_model_id)
            $loghistories = $loghistories->where('on_model_id', $this->on_model_id);


        if ($this->admin_view_status == 'deleted')
            $loghistories = $loghistories->onlyTrashed();


        $loghistories = $loghistories->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.loghistory.loghistory-index', compact('loghistories'));
    }
}
