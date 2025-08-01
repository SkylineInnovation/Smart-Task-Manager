<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guarded = ['user'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    // protected $with = [];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    // protected $withCount = [];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    // protected $perPage = 15;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'add_by',
        'first_name',
        'last_name',
        'user_name',

        'email',
        'is_email_verified',
        'email_verified_at',
        'password',

        'phone',
        'fire_base_uid',
        'is_phone_verified',
        'device_token',

        'fire_base_phone_uid',
        'fire_base_google_uid',
        'fire_base_facebook_uid',
        'fire_base_apple_uid',

        'gender',
        'birth_day',
        'language',

        'image',

        'status',
        'last_time_use',

        'active_until',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fire_base_uid',
        // 'device_token',

        'fire_base_phone_uid',
        'fire_base_google_uid',
        'fire_base_facebook_uid',
        'fire_base_apple_uid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_phone_verified' => 'boolean',
        'is_email_verified' => 'boolean',

        'last_time_use' => 'datetime',
        'active_until' => 'datetime',

        'email_verified_at' => 'datetime',
    ];

    public function crud_name()
    {
        $title = $this->detail ? $this->detail->title . ' ' : '';

        return $title . $this->first_name . ' ' . $this->last_name;
    }

    public function name()
    {
        $title = $this->detail ? $this->detail->title . ' ' : '';

        return $title . $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute()
    {
        return $this->image ?? 'assets/images/users/12.jpg';
    }

    // public function image(){
    //     return asset($this->image);
    // }

    public function rolesSideBySide()
    {
        $text = '';
        foreach ($this->roles as $role) $text = $text . $role->the_display_name() . ', ';
        return $text;
    }

    public static function livewireSearch($search)
    {
        $qqq = static::query();

        // if (!auth()->user()->hasRole(['owner', 'manager'])) {
        //     $qqq = $qqq->where('add_by', auth()->user()->id);

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%");

            $q->orWhereSearch('first_name', $search);
            $q->orWhereSearch('last_name', $search);
            $q->orWhereRaw('concat(first_name, " ", last_name) like "%' . $search . '%"');
            // $q->orWhereSearch('user_name', $search);
            $q->orWhereSearch('email', $search);
            $q->orWhereSearch('phone', $search);
        })->orWhereHas('departments', function ($q) use ($search) {
            $q->whereSearch('name', $search);
        });
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_manager', 'manager_id', 'employee_id');
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'employee_manager', 'employee_id', 'manager_id');
    }

    public function manager_names()
    {
        $text = '';
        foreach ($this->managers as $manager)
            $text .= $manager->name() . '<br>';
        return $text;
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_employee', 'department_id', 'employee_id');
    }

    public function department_names()
    {
        $text = '';
        foreach ($this->departments as $department)
            $text .= $department->name . '<br>';
        return $text;
    }

    public function branches_name()
    {
        $text = '';
        foreach ($this->departments as $department)
            $text .= $department->branch->name . '<br>';
        return $text;
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_manager', 'branch_id', 'manager_id');
    }

    public function details()
    {
        return $this->hasMany(UserDetail::class);
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class)->latestOfMany();
    }

    public function tasks_by_manager($manager, $from_date = null, $to_date = null, $by_date = null)
    {
        // whereBetween($this->by_date, [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59'])
        $tasks = new Task;
        if ($by_date && $from_date && $to_date)
            $tasks = $tasks->whereBetween($by_date, [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);

        $tasks = $tasks->where('manager_id', $manager->id);

        $tasks = $tasks->whereHas('employees', function ($q) {
            $q->where('id', $this->id);
        });

        $tasks = $tasks->get();

        return $tasks;
    }
}
