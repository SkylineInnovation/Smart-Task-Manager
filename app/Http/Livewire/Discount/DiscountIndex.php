<?php

namespace App\Http\Livewire\Discount;

use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $search = '';
    public $orderBy = 'id';
    public $orderWay = 'desc';
    public $showColumn;

    public $all;
    public $fromDate = null;
    public $toDate = null;
    public $byDate = 'created_at';

    public $selectedDiscounts = [];

    public Discount $discount;
    private $discounts;
    public $user;


    public $tasks = [];

    public $users = [];



    public $filter_tasks_id = [];

    public $filter_users_id = [];


    public $the_user_id;
    public $the_task_id;

    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $user_id = null, $task_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->discount = new Discount();

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

        $this->users = \App\Models\User::whereRoleIs('employee')->orderBy('first_name')->get();


        $this->showColumn = collect([
            'id' => true,
            'slug' => false,


            'task_id' => true,
            'user_id' => true,
            'amount' => true,
            'reason' => true,

            // 'status' => false,
            'date' => true,
            'time' => true,
        ]);
    }

    public $slug;
    public $discount_id, $task_id, $user_id, $amount, $reason;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        // $this->task_id = null;
        // $this->user_id = null;
        $this->amount = '';
        $this->reason = '';
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'task_id' => 'required',
            'user_id' => 'required',
            'amount' => 'required',
            // 'reason' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Discount::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'reason' => $this->reason,
        ]);

        session()->flash('message', 'Discount Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $discount = Discount::find($id);
        $this->discount = $discount;
        $this->discount_id = $id;
        $this->slug = $discount->slug;


        $this->task_id = $discount->task_id;
        $this->user_id = $discount->user_id;
        $this->amount = $discount->amount;
        $this->reason = $discount->reason;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->discount_id) {
            $discount = Discount::find($this->discount_id);
            $discount->update([
                'slug' => $this->slug,

                'task_id' => $this->task_id,
                'user_id' => $this->user_id,
                'amount' => $this->amount,
                'reason' => $this->reason,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Discount Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $discount = Discount::find($id);

            $discount->delete();

            session()->flash('message', 'Discount Deleted Successfully.');
        }
    }

    public function restore($id)
    {
        if ($id) {
            $discount = Discount::withTrashed()->find($id);

            $discount->restore();

            session()->flash('message', 'Discount Recovered Successfully.');
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
        $discounts = Discount::livewireSearch($this->search);

        if ($this->all == false)
            $discounts = $discounts->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_tasks_id)
            $discounts = $discounts->whereIn('task_id', $this->filter_tasks_id);

        if ($this->filter_users_id)
            $discounts = $discounts->whereIn('user_id', $this->filter_users_id);

        if ($this->the_user_id)
            $discounts = $discounts->where('user_id', $this->the_user_id);

        if ($this->the_task_id)
            $discounts = $discounts->where('task_id', $this->the_task_id);


        if ($this->admin_view_status == 'deleted')
            $discounts = $discounts->onlyTrashed();


        $discounts = $discounts->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.discount.discount-index', compact('discounts'));
    }
}
