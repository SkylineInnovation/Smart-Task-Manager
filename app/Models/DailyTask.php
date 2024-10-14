<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Laratrust\Traits\LaratrustUserTrait;

class DailyTask extends Model
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


        'manager_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'proearty',
        'status',
        'repeat_time',
        'repeat_evrey',

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

        if (!auth()->user()->hasRole(['owner', 'manager'])) {
            $qqq = $qqq->where('add_by', auth()->user()->id);
        }

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->whereIn('id', array_map('intval', explode(',', $search)));


            $q->orWhere('manager_id', $search);
            $q->orWhereSearch('title', $search);
            $q->orWhereSearch('description', $search);
            $q->orWhereSearch('start_time', $search);
            $q->orWhereSearch('end_time', $search);
            $q->orWhereSearch('proearty', $search);
            $q->orWhereSearch('status', $search);
            $q->orWhereSearch('repeat_time', $search);
            $q->orWhereSearch('repeat_evrey', $search);

            // })->orWhereHas('add_by_user', function ($q) use ($search) {
            //     $q->orWhereSearch('first_name', $search);
            //     $q->orWhereSearch('last_name', $search);
            //     $q->orWhereRaw('concat(first_name, " ", last_name) like "%' . $search . '%"');
            //     $q->orWhereSearch('email', $search);
            //     $q->orWhereSearch('phone', $search);
        });
    }

    public function the_proearty()
    {
        if ($this->proearty == 'low')
            return __('task.low');
        elseif ($this->proearty == 'medium')
            return __('task.medium');
        elseif ($this->proearty == 'high')
            return __('task.high');
        elseif ($this->proearty == 'urgent')
            return __('task.urgent');

        return '';
    }

    public function the_priority_color()
    {
        if ($this->proearty == 'low')
            return '#00FF00';
        elseif ($this->proearty == 'medium')
            return '#0000FF';
        elseif ($this->proearty == 'high')
            return '#FF0000';
        elseif ($this->proearty == 'urgent') // TODO
            return '#FF0000';

        return '';
    }

    public function the_status()
    {
        if ($this->status == 'pending')
            return __('task.pending');
        elseif ($this->status == 'active')
            return __('task.active');
        elseif ($this->status == 'auto-finished')
            return __('task.auto-finished');
        elseif ($this->status == 'manual-finished')
            return __('task.manual-finished');

        return '';
    }

    public function add_by_user()
    {
        return $this->belongsTo(User::class, 'add_by');
    }



    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'daily_task_user')->withPivot('discount');
    }

    public function discount()
    {
        return $this->employees->first()->pivot->discount;
    }
}
