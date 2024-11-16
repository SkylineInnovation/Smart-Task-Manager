<?php

namespace App\Http\Livewire\Otpsendcode;

use App\Models\OtpSendCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class OtpsendcodeIndex extends Component
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

    public $selectedOtpSendCodes = [];

    public OtpSendCode $otpsendcode;
    private $otpsendcodes;
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

        $this->otpsendcode = new OtpSendCode();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        // $this->users = \App\Models\User::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'otp_code' => true,
            'phone_number' => true,
            'applecation' => true,
            'code_status' => true,
            'back_response' => true,

            // 'status' => false,
            'date' => true,
            'time' => true,
        ]);
    }

    public $slug;
    public $otpsendcode_id, $user_id, $otp_code, $phone_number, $applecation, $code_status, $back_response;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = '';
        $this->otp_code = '';
        $this->phone_number = '';
        $this->applecation = '';
        $this->code_status = '';
        $this->back_response = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'otp_code' => 'required',
            'phone_number' => 'required',
            'applecation' => 'required',
            'code_status' => 'required',
            'back_response' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        OtpSendCode::create([
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'otp_code' => $this->otp_code,
            'phone_number' => $this->phone_number,
            'applecation' => $this->applecation,
            'code_status' => $this->code_status,
            'back_response' => $this->back_response,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $otpsendcode = OtpSendCode::where('id', $id)->first();
        $this->otpsendcode_id = $id;
        $this->slug = $otpsendcode->slug;


        $this->user_id = $otpsendcode->user_id;
        $this->otp_code = $otpsendcode->otp_code;
        $this->phone_number = $otpsendcode->phone_number;
        $this->applecation = $otpsendcode->applecation;
        $this->code_status = $otpsendcode->code_status;
        $this->back_response = $otpsendcode->back_response;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->otpsendcode_id) {
            $otpsendcode = OtpSendCode::find($this->otpsendcode_id);
            $otpsendcode->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'otp_code' => $this->otp_code,
                'phone_number' => $this->phone_number,
                'applecation' => $this->applecation,
                'code_status' => $this->code_status,
                'back_response' => $this->back_response,
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
            $otpsendcode = OtpSendCode::find($id);

            $otpsendcode->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $otpsendcode = OtpSendCode::withTrashed()->find($id);

            $otpsendcode->restore();

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
        $otpsendcodes = OtpSendCode::livewireSearch($this->search);

        if ($this->all == false)
            $otpsendcodes = $otpsendcodes->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $otpsendcodes = $otpsendcodes->whereIn('user_id', $this->filter_users_id);


        if ($this->admin_view_status == 'deleted')
            $otpsendcodes = $otpsendcodes->onlyTrashed();


        $otpsendcodes = $otpsendcodes->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.otpsendcode.otpsendcode-index', compact('otpsendcodes'));
    }
}
