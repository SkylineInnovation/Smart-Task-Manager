<?php

namespace App\Http\Livewire\Passwordcode;

use App\Models\PasswordCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class PasswordcodeIndex extends Component
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

    public $selectedPasswordCodes = [];

    public PasswordCode $passwordcode;
    private $passwordcodes;
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

        $this->passwordcode = new PasswordCode();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        // $this->users = \App\Models\User::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'code' => true,
            'note' => true,
            'is_used' => true,
            'ip_address' => true,

            // 'status' => false,
            'date' => true,
            'time' => true,
        ]);
    }

    public $slug;
    public $passwordcode_id, $user_id, $code, $note, $is_used, $ip_address;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = '';
        $this->code = '';
        $this->note = '';
        $this->is_used = '';
        $this->ip_address = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'code' => 'required',
            'note' => 'required',
            'is_used' => 'required',
            'ip_address' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        PasswordCode::create([
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'code' => $this->code,
            'note' => $this->note,
            'is_used' => $this->is_used,
            'ip_address' => $this->ip_address,
        ]);

        session()->flash('message', 'PasswordCode Created Successfully.');

        $this->resetInputFields();

        // $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $passwordcode = PasswordCode::where('id', $id)->first();
        $this->passwordcode_id = $id;
        $this->slug = $passwordcode->slug;


        $this->user_id = $passwordcode->user_id;
        $this->code = $passwordcode->code;
        $this->note = $passwordcode->note;
        $this->is_used = $passwordcode->is_used;
        $this->ip_address = $passwordcode->ip_address;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->passwordcode_id) {
            $passwordcode = PasswordCode::find($this->passwordcode_id);
            $passwordcode->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'code' => $this->code,
                'note' => $this->note,
                'is_used' => $this->is_used,
                'ip_address' => $this->ip_address,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'PasswordCode Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $passwordcode = PasswordCode::find($id);

            $passwordcode->delete();

            session()->flash('message', 'PasswordCode Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $passwordcode = PasswordCode::withTrashed()->find($id);

            $passwordcode->restore();

            session()->flash('message', 'PasswordCode Recovered Successfully.');
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
        $passwordcodes = PasswordCode::livewireSearch($this->search);

        if ($this->all == false)
            $passwordcodes = $passwordcodes->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $passwordcodes = $passwordcodes->whereIn('user_id', $this->filter_users_id);


        if ($this->admin_view_status == 'deleted')
            $passwordcodes = $passwordcodes->onlyTrashed();


        $passwordcodes = $passwordcodes->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.passwordcode.passwordcode-index', compact('passwordcodes'));
    }
}
