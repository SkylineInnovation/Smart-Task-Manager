<?php

namespace App\Http\Livewire\Userdetail;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class UserdetailIndex extends Component
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

    public $selectedUserDetails = [];

    public UserDetail $userdetail;
    private $userdetails;
    public $user;


    public $users = [];

    public $branches = [];



    public $filter_users_id = [];

    public $filter_branches_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->userdetail = new UserDetail();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->users = \App\Models\User::orderBy('first_name')->get();

        $this->branches = \App\Models\Branch::where('show', 1)->orderBy('sort')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'user_id' => true,
            'title' => true,
            'nationality' => true,
            'id_number' => true,
            'address' => true,
            'qualification' => true,
            'salary' => true,
            'home' => true,
            'transport' => true,
            'branch_id' => true,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $userdetail_id, $user_id, $title, $nationality, $id_number, $address, $qualification, $salary, $home, $transport, $branch_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->user_id = null;
        $this->title = '';
        $this->nationality = '';
        $this->id_number = '';
        $this->address = '';
        $this->qualification = '';
        $this->salary = '';
        $this->home = '';
        $this->transport = '';
        $this->branch_id = null;
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'user_id' => 'required',
            'title' => 'required',
            'nationality' => 'required',
            'id_number' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'salary' => 'required',
            'home' => 'required',
            'transport' => 'required',
            'branch_id' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        UserDetail::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'user_id' => $this->user_id,
            'title' => $this->title,
            'nationality' => $this->nationality,
            'id_number' => $this->id_number,
            'address' => $this->address,
            'qualification' => $this->qualification,
            'salary' => $this->salary,
            'home' => $this->home,
            'transport' => $this->transport,
            'branch_id' => $this->branch_id,
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $userdetail = UserDetail::find($id);
        $this->userdetail = $userdetail;
        $this->userdetail_id = $id;
        $this->slug = $userdetail->slug;


        $this->user_id = $userdetail->user_id;
        $this->title = $userdetail->title;
        $this->nationality = $userdetail->nationality;
        $this->id_number = $userdetail->id_number;
        $this->address = $userdetail->address;
        $this->qualification = $userdetail->qualification;
        $this->salary = $userdetail->salary;
        $this->home = $userdetail->home;
        $this->transport = $userdetail->transport;
        $this->branch_id = $userdetail->branch_id;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->userdetail_id) {
            $userdetail = UserDetail::find($this->userdetail_id);
            $userdetail->update([
                'slug' => $this->slug,

                'user_id' => $this->user_id,
                'title' => $this->title,
                'nationality' => $this->nationality,
                'id_number' => $this->id_number,
                'address' => $this->address,
                'qualification' => $this->qualification,
                'salary' => $this->salary,
                'home' => $this->home,
                'transport' => $this->transport,
                'branch_id' => $this->branch_id,
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
            $userdetail = UserDetail::find($id);

            $userdetail->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $userdetail = UserDetail::withTrashed()->find($id);

            $userdetail->restore();

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

        $this->filter_branches_id = [];
    }


    public $select_user;
    public function updatedSelectUser($val)
    {
        $this->filter_users_id[] = $val;
    }


    public $select_branch;
    public function updatedSelectBranch($val)
    {
        $this->filter_branches_id[] = $val;
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
        $userdetails = UserDetail::livewireSearch($this->search);

        if ($this->all == false)
            $userdetails = $userdetails->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_users_id)
            $userdetails = $userdetails->whereIn('user_id', $this->filter_users_id);

        if ($this->filter_branches_id)
            $userdetails = $userdetails->whereIn('branch_id', $this->filter_branches_id);


        if ($this->admin_view_status == 'deleted')
            $userdetails = $userdetails->onlyTrashed();


        $userdetails = $userdetails->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.userdetail.userdetail-index', compact('userdetails'));
    }
}
