<?php

namespace App\Http\Livewire\Exchangepermission;

use App\Http\Controllers\HomeController;
use App\Models\ExchangePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ExchangepermissionIndex extends Component
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

    public $selectedExchangePermissions = [];

    public ExchangePermission $exchangepermission;
    private $exchangepermissions;
    public $user;


    public $users = [];

    public $financial_directors = [];

    public $technical_directors = [];



    public $filter_users_id = [];

    public $filter_financial_directors_id = [];

    public $filter_technical_directors_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->exchangepermission = new ExchangePermission();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->users = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();

        $this->financial_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();

        $this->technical_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'content' => true,
            'amount' => true,
            'attachment' => true,
            'request_date' => true,
            'financial_director_id' => true,
            'financial_director_response' => true,
            'financial_director_time' => true,
            'technical_director_id' => true,
            'technical_director_response' => true,
            'technical_director_time' => true,
            'status' => true,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $exchangepermission_id, $user_id, $content, $amount, $attachment, $request_date, $financial_director_id, $financial_director_response, $financial_director_time, $technical_director_id, $technical_director_response, $technical_director_time, $status;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = null;
        $this->content = '';
        $this->amount = '';
        $this->attachment = '';
        $this->request_date = '';
        $this->financial_director_id = null;
        $this->financial_director_response = '';
        $this->financial_director_time = '';
        $this->technical_director_id = null;
        $this->technical_director_response = '';
        $this->technical_director_time = '';
        $this->status = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'content' => 'required',
            'amount' => 'required',
            'attachment' => 'required',
            'request_date' => 'required',
            'financial_director_id' => 'required',
            'financial_director_response' => 'required',
            'financial_director_time' => 'required',
            'technical_director_id' => 'required',
            'technical_director_response' => 'required',
            'technical_director_time' => 'required',
            'status' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        ExchangePermission::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'content' => $this->content,
            'amount' => $this->amount,
            'attachment' => HomeController::saveImageWeb($this->attachment, 'exchange_permission'),
            'request_date' => $this->request_date,
            'financial_director_id' => $this->financial_director_id,
            'financial_director_response' => $this->financial_director_response,
            'financial_director_time' => $this->financial_director_time,
            'technical_director_id' => $this->technical_director_id,
            'technical_director_response' => $this->technical_director_response,
            'technical_director_time' => $this->technical_director_time,
            'status' => $this->status,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $exchangepermission = ExchangePermission::find($id);
        $this->exchangepermission = $exchangepermission;
        $this->exchangepermission_id = $id;
        $this->slug = $exchangepermission->slug;


        $this->user_id = $exchangepermission->user_id;
        $this->content = $exchangepermission->content;
        $this->amount = $exchangepermission->amount;
        // $this->attachment = $exchangepermission->attachment;
        $this->request_date = $exchangepermission->request_date;
        $this->financial_director_id = $exchangepermission->financial_director_id;
        $this->financial_director_response = $exchangepermission->financial_director_response;
        $this->financial_director_time = $exchangepermission->financial_director_time;
        $this->technical_director_id = $exchangepermission->technical_director_id;
        $this->technical_director_response = $exchangepermission->technical_director_response;
        $this->technical_director_time = $exchangepermission->technical_director_time;
        $this->status = $exchangepermission->status;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->exchangepermission_id) {
            $exchangepermission = ExchangePermission::find($this->exchangepermission_id);
            $exchangepermission->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'content' => $this->content,
                'amount' => $this->amount,
                'attachment' => $this->attachment ? HomeController::saveImageWeb($this->attachment, 'exchange_permission') : $exchangepermission->attachment,
                'request_date' => $this->request_date,
                'financial_director_id' => $this->financial_director_id,
                'financial_director_response' => $this->financial_director_response,
                'financial_director_time' => $this->financial_director_time,
                'technical_director_id' => $this->technical_director_id,
                'technical_director_response' => $this->technical_director_response,
                'technical_director_time' => $this->technical_director_time,
                'status' => $this->status,
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
            $exchangepermission = ExchangePermission::find($id);

            $exchangepermission->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $exchangepermission = ExchangePermission::withTrashed()->find($id);

            $exchangepermission->restore();

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


        $this->filter_users_id = [];

        $this->filter_financial_directors_id = [];

        $this->filter_technical_directors_id = [];
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
    }


    public $select_financial_director;
    public function updatedSelectFinancial_director($val)
    {
        $this->filter_financial_directors_id[] = $val;
    }


    public $select_technical_director;
    public function updatedSelectTechnical_director($val)
    {
        $this->filter_technical_directors_id[] = $val;
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
        $exchangepermissions = ExchangePermission::livewireSearch($this->search);

        if ($this->all == false)
            $exchangepermissions = $exchangepermissions->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $exchangepermissions = $exchangepermissions->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_financial_directors_id)
            $exchangepermissions = $exchangepermissions->whereIn('financial_director_id', $this->filter_financial_directors_id);

        if ($this->filter_technical_directors_id)
            $exchangepermissions = $exchangepermissions->whereIn('technical_director_id', $this->filter_technical_directors_id);


        if ($this->admin_view_status == 'deleted')
            $exchangepermissions = $exchangepermissions->onlyTrashed();


        $exchangepermissions = $exchangepermissions->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.exchangepermission.exchangepermission-index', compact('exchangepermissions'));
    }
}
