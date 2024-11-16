<?php

namespace App\Http\Livewire\Devicetokenlist;

use App\Models\DeviceTokenList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class DevicetokenlistIndex extends Component
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

    public $selectedDeviceTokenLists = [];

    public DeviceTokenList $devicetokenlist;
    private $devicetokenlists;
    public $user;


    public $users = [];



    public $filter_users_id = [];


    public $url;
    public $admin_view_status = '';
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();

        $this->devicetokenlist = new DeviceTokenList();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        // $this->users = \App\Models\User::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'device_info' => true,
            'device_type' => true,
            'application' => true,
            'device_token' => true,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $devicetokenlist_id, $user_id, $device_info, $device_type, $application, $device_token;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = '';
        $this->device_info = '';
        $this->device_type = '';
        $this->application = '';
        $this->device_token = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'device_info' => 'required',
            'device_type' => 'required',
            'application' => 'required',
            'device_token' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        DeviceTokenList::create([
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'device_info' => $this->device_info,
            'device_type' => $this->device_type,
            'application' => $this->application,
            'device_token' => $this->device_token,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $devicetokenlist = DeviceTokenList::where('id', $id)->first();
        $this->devicetokenlist_id = $id;
        $this->slug = $devicetokenlist->slug;


        $this->user_id = $devicetokenlist->user_id;
        $this->device_info = $devicetokenlist->device_info;
        $this->device_type = $devicetokenlist->device_type;
        $this->application = $devicetokenlist->application;
        $this->device_token = $devicetokenlist->device_token;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->devicetokenlist_id) {
            $devicetokenlist = DeviceTokenList::find($this->devicetokenlist_id);
            $devicetokenlist->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'device_info' => $this->device_info,
                'device_type' => $this->device_type,
                'application' => $this->application,
                'device_token' => $this->device_token,
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
            $devicetokenlist = DeviceTokenList::find($id);

            $devicetokenlist->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $devicetokenlist = DeviceTokenList::withTrashed()->find($id);

            $devicetokenlist->restore();

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
        $devicetokenlists = DeviceTokenList::livewireSearch($this->search);

        if ($this->all == false)
            $devicetokenlists = $devicetokenlists->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $devicetokenlists = $devicetokenlists->whereIn('user_id', $this->filter_users_id);


        if ($this->admin_view_status == 'deleted')
            $devicetokenlists = $devicetokenlists->onlyTrashed();


        $devicetokenlists = $devicetokenlists->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.devicetokenlist.devicetokenlist-index', compact('devicetokenlists'));
    }
}
