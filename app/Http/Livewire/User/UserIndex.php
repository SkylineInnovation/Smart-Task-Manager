<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class UserIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $order = 'desc';
    public $showColumn;

    public $selectedUsers = [];

    public $roles = [];
    public $selectedRoles = [];

    public $employees = [];
    public $selectedEmployees = [];

    public User $user;
    private $users;

    public $ids = [];

    public $auth;
    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '', $the_manager_id = null, $the_employee_id = null)
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->auth = Auth::user();
        $this->by = session()->get('admin_user', $this->auth);


        $this->user = new User();

        $this->employees = User::whereRoleIs('employee')->get();

        // $this->roles = Role::whereIn('name', ['owner',])->get();
        $this->roles = Role::get();

        if ($this->auth->hasRole('manager')) {
            $employeeRole = Role::where('name', 'employee')->first();

            $this->selectedRoles = [$employeeRole->id];
        }


        $this->ids = $this->by->employees->pluck('id');

        $this->showColumn = collect([
            'id' => false,
            'name' => true,
            'first_name' => false,
            'last_name' => false,
            'user_name' => false,
            'email' => true,
            'phone' => false,
            'gender' => false,
            'birth_day' => false,
            'status' => false,
            'created_at' => false,
        ]);
    }

    public $first_name, $last_name, $user_name, $email, $password, $phone, $gender, $birth_day, $status, $active_until, $user_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->user_name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->gender = 'male';
        $this->birth_day = '';
        $this->status = '';
        $this->active_until = '';

        $this->selectedRoles = [];
        $this->selectedEmployees = [];
    }

    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,
            'first_name' => 'required',
            // 'user_name' => 'required|unique:users,user_name,' . $this->user_id,
            'email' => 'required|unique:users,email,' . $this->user_id,
            'phone' => 'required|unique:users,phone,' . $this->user_id,
            'password' => !$this->updateMode ? 'required' : 'nullable',

            'selectedRoles' => 'required',
        ];
    }

    protected $messages = [
        'selectedRoles.required' => 'Please Select Role',
    ];


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
            'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birth_day' => $this->birth_day,
        ]);

        // $teamRole = Role::where('name', 'team')->first();
        // $user->attachRole($teamRole);

        $user->syncRoles($this->selectedRoles);


        $user->employees()->sync($this->selectedEmployees);

        if ($this->by->hasRole('manager')) {
            try {
                $this->by->employees()->attach($user->id);
            } catch (\Throwable $th) {
            }
        }

        Artisan::call('cache:clear');

        session()->flash('message', 'Users Created Successfully.');

        $this->resetInputFields();

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id', $id)->first();
        $this->user_id = $id;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->user_name = $user->user_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->birth_day = $user->birth_day;

        $this->selectedRoles = $user->roles->pluck('id');
        $this->selectedEmployees = $user->employees->pluck('id');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        // $validatedDate = $this->validate([
        //     'first_name' => 'required',
        //     'email' => 'required|email',
        // ]);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'user_name' => $this->user_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'birth_day' => $this->birth_day,
            ]);

            if ($this->password)
                $user->update(['password' => Hash::make($this->password)]);

            $user->syncRoles($this->selectedRoles);

            $user->employees()->sync($this->selectedEmployees);

            Artisan::call('cache:clear');

            $this->updateMode = false;
            session()->flash('message', 'Users Updated Successfully.');
            $this->resetInputFields();
        }

        $this->emit('close-model'); // Close model to using to jquery
    }

    public function delete($id)
    {
        if ($id) {
            $user = User::find($id);

            $user->update([
                'email' => uniqid() . '--' . $user->email . '--' . uniqid(),
                'phone' => uniqid() . '--' . $user->phone . '--' . uniqid(),
            ]);

            $user->delete();

            session()->flash('message', 'Users Deleted Successfully.');
        }
    }

    // public function activateUser($id)
    // {
    //     if ($id) {
    //         $user = User::find($id);
    //         $user->update(['status' => 'active']);
    //         session()->flash('message', 'User Active');
    //     }
    // }

    // public function blockUser($id)
    // {
    //     if ($id) {
    //         $user = User::find($id);
    //         $user->update(['status' => 'blocked']);
    //         session()->flash('message', 'User Blocked');
    //     }
    // }

    public function render()
    {
        $users = User::livewireSearch($this->search);

        if ($this->by->hasRole('manager')) {
            $users = $users->whereIn('id', $this->ids);
        }

        $users = $users->orderBy($this->orderBy, $this->order)
            ->paginate($this->perPage);

        return view('livewire.user.user-index', compact('users'));
    }
}
