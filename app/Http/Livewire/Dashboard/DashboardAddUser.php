<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DashboardAddUser extends Component
{
    public $branches = [];
    public $roles = [];

    public $selectedRoles = [];

    public $first_name, $last_name,
        $email, $password, $phone;

    public $title, $nationality,
        $id_number, $address, $qualification,
        $salary = 0, $home = 0, $transport = 0,
        $branch_id;


    public $selectBranch = [];


    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        $this->branches = \App\Models\Branch::get();
        $this->roles = Role::get(); // whereIn('name', ['employee',])->
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->title = '';
        $this->nationality = '';
        $this->id_number = '';
        $this->address = '';
        $this->qualification = '';
        $this->salary = 0;
        $this->home = 0;
        $this->transport = 0;
        $this->branch_id = null;

        $this->selectedRoles = [];
    }


    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,


            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'title' => 'required',
            'nationality' => 'required',
            'id_number' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'salary' => 'required',
            'home' => 'required',
            'transport' => 'required',
            // 'branch_id' => 'required',


            'selectBranch' => 'required|array|min:1',
            'selectBranch.*' => 'integer|exists:users,id',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            // 'gender' => $this->gender,
            // 'birth_day' => $this->birth_day,
        ]);

        $user->syncRoles($this->selectedRoles);
        // UserDetail::create([

        //     'user_id' => $user->id,
        //     'title' => $this->title,
        //     'nationality' => $this->nationality,
        //     'id_number' => $this->id_number,
        //     'address' => $this->address,
        //     'qualification' => $this->qualification,
        //     'salary' => $this->salary,
        //     'home' => $this->home,
        //     'transport' => $this->transport,
        //     'branch_id' => $this->branch_id,
        // ]);
        foreach ($this->selectBranch as $branch) {
            UserDetail::create([

                'user_id' => $user->id,
                'title' => $this->title,
                'nationality' => $this->nationality,
                'id_number' => $this->id_number,
                'address' => $this->address,
                'qualification' => $this->qualification,
                'salary' => $this->salary,
                'home' => $this->home,
                'transport' => $this->transport,
                'branch_id' => $branch,
            ]);
        }

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-user');
    }
}
