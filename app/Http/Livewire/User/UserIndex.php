<?php

namespace App\Http\Livewire\User;

use App\Jobs\SendNewUser;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
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

    // public $employees = [];
    // public $selectedEmployees = [];

    public $managers = [];
    public $selectedManagers = [];

    public $departments = [];
    public $selectedDepartments = [];

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

        // $this->employees = User::whereRoleIs('employee')->get();
        $this->managers = User::whereRoleIs('manager')->get();

        $this->branches = \App\Models\Branch::get();

        // $this->departments = Department::get();

        $this->roles = Role::get();
        // $this->roles = Role::get();

        if ($this->auth->hasRole('manager')) {
            $employeeRole = Role::where('name', 'employee')->first();

            $this->selectedRoles = [$employeeRole->id];
        }


        $this->ids = $this->by->employees->pluck('id')->toArray();

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

    public $branches = [];

    public $title, $nationality,
        $id_number, $address, $qualification,
        $salary = 0, $home = 0, $transport = 0,
        $branch_id;

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
        // $this->selectedEmployees = [];
        $this->selectedManagers = [];
        $this->selectedDepartments = [];

        $this->edit_user = null;

        $this->title = '';
        $this->nationality = '';
        $this->id_number = '';
        $this->address = '';
        $this->qualification = '';
        $this->salary = 0;
        $this->home = 0;
        $this->transport = 0;
        $this->branch_id = null;

        $this->select_man = '';
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
            // 'selectedDepartments' => 'required',

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

    protected $messages = [
        'selectedRoles.required' => 'Please Select Role',
        'selectedDepartments.required' => 'Please Select Department',
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


        // $user->employees()->sync($this->selectedEmployees);
        foreach ($this->selectedManagers as $selectedManagerID) {
            $user->managers()->sync($selectedManagerID);
        }

        $user->departments()->sync($this->selectedDepartments);

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
            'branch_id' => $this->branch_id,
        ]);

        if ($this->by->hasRole('manager')) {
            try {
                $this->by->employees()->attach($user->id);
            } catch (\Throwable $th) {
            }
        }

        Artisan::call('cache:clear');

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message

        if (env('SEND_MAIL', false))
            SendNewUser::dispatch($user);
    }

    public $edit_user;
    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id', $id)->first();
        $this->user_id = $id;

        $this->edit_user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->user_name = $user->user_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->birth_day = $user->birth_day;

        // 
        if (!$user->detail) {
            $user->detail = UserDetail::create([
                'user_id' => $user->id,
                'salary' => 0,
                'home' => 0,
                'transport' => 0,
                'branch_id' => 0,
            ]);
        }

        $this->title = $user->detail->title;
        $this->nationality = $user->detail->nationality;
        $this->id_number = $user->detail->id_number;
        $this->address = $user->detail->address;
        $this->qualification = $user->detail->qualification;
        $this->salary = $user->detail->salary;
        $this->home = $user->detail->home;
        $this->transport = $user->detail->transport;
        $this->branch_id = $user->detail->branch_id;

        $this->departments = \App\Models\Department::where('branch_id', $this->branch_id)
            ->where('show', 1)->orderBy('sort')->get();

        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        // $this->selectedEmployees = $user->employees->pluck('id')->toArray();
        $this->selectedManagers = $user->managers->pluck('id')->toArray();
        $this->selectedDepartments = $user->departments->pluck('id')->toArray();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public $select_man;
    public function updatedSelectMan($val)
    {
        $this->selectedManagers[] = $val;
    }

    public function update()
    {
        $validatedData = $this->validate();

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

            // $user->employees()->sync($this->selectedEmployees);
            $user->managers()->sync($this->selectedManagers);
            $user->departments()->sync($this->selectedDepartments);

            $detail = UserDetail::where('user_id', $user->id)->latest()->first();

            $detail->update([
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

            Artisan::call('cache:clear');

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
            $user = User::find($id);

            $user->update([
                'email' => uniqid() . '--' . $user->email . '--' . uniqid(),
                'phone' => uniqid() . '--' . $user->phone . '--' . uniqid(),
            ]);

            $user->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function activateUser($id)
    {
        if ($id) {
            $user = User::find($id);
            $user->update(['status' => 'active']);
            session()->flash('message', 'User Active');
        }
    }

    public function blockUser($id)
    {
        if ($id) {
            $user = User::find($id);
            $user->update(['status' => 'blocked']);
            session()->flash('message', 'User Blocked');
        }
    }

    public function updatedBranchId($val)
    {
        $this->departments = \App\Models\Department::where('branch_id', $this->branch_id)
            ->where('show', 1)->orderBy('sort')->get();

        $this->selectedDepartments = [];
    }

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
