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
        return $this->first_name . ' ' . $this->last_name;
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name . ' (' . $this->id . ')';
    }

    // public function image(){
    //     return asset($this->image);
    // }

    public function rolesSideBySide()
    {
        $text = '';
        foreach ($this->roles as $role) $text = $text . $role->name . ', ';
        return $text;
    }

    public static function livewireSearch($search)
    {
        $qqq = static::query();

        // if (!auth()->user()->hasRole(['owner',]))
        //     $qqq = $qqq->where('add_by', auth()->user()->id);

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%");

            $q->orWhereSearch('first_name', $search);
            $q->orWhereSearch('last_name', $search);
            $q->orWhereSearch('user_name', $search);
            $q->orWhereSearch('email', $search);
            $q->orWhereSearch('phone', $search);
        });
    }
}
