<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Laratrust\Traits\LaratrustUserTrait;

class UserDetail extends Model
{
    // use LaratrustUserTrait;
    use HasFactory;
    use SoftDeletes;

    // use Translatable trait to translate the columns 
    use TranslateTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table;

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
    protected $perPage = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'add_by',
        'slug',


        'user_id',
        'title',
        'nationality',
        'id_number',
        'address',
        'qualification',
        'salary',
        'home',
        'transport',
        'branch_id',

        'show',
        'sort',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // 
        });

        static::updating(function ($model) {
            // Check which attributes are being updated
            $dirtyAttributes = $model->getDirty();

            // Get the old values for the updated attributes
            $oldValues = [];
            foreach ($dirtyAttributes as $attribute => $value)
                $oldValues[$attribute] = $model->getOriginal($attribute);

            // 'subscription_id' => $model->id,
            // 'from_type_id' => $model->getOriginal()['subscription_type_id'],
            // 'to_type_id' => $model->getAttributes()['subscription_type_id'],
        });
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'show',
        'sort',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show' => 'boolean',
        'sort' => 'integer',

        // 'the_name' => 'json',
    ];

    public function crud_name()
    {
        return $this->id;
    }

    // public function name($lang = null)
    // {
    //     return $this->translateCol($this->the_name, $lang);
    // }

    public static function livewireSearch($search)
    {
        $qqq = static::query();

        // if (!auth()->user()->hasRole(['owner', 'manager'])) {
        //     $qqq = $qqq->where('add_by', auth()->user()->id);
        // }

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->whereIn('id', array_map('intval', explode(',', $search)));


            $q->orWhere('user_id', $search);
            $q->orWhereSearch('title', $search);
            $q->orWhereSearch('nationality', $search);
            $q->orWhereSearch('id_number', $search);
            $q->orWhereSearch('address', $search);
            $q->orWhereSearch('qualification', $search);
            $q->orWhereSearch('salary', $search);
            $q->orWhereSearch('home', $search);
            $q->orWhereSearch('transport', $search);
            $q->orWhere('branch_id', $search);

            // })->orWhereHas('add_by_user', function ($q) use ($search) {
            //     $q->orWhereSearch('first_name', $search);
            //     $q->orWhereSearch('last_name', $search);
            //     $q->orWhereRaw('concat(first_name, " ", last_name) like "%' . $search . '%"');
            //     $q->orWhereSearch('email', $search);
            //     $q->orWhereSearch('phone', $search);
        });
    }

    public function add_by_user()
    {
        return $this->belongsTo(User::class, 'add_by');
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
