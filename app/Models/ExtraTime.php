<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Laratrust\Traits\LaratrustUserTrait;

class ExtraTime extends Model
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


        'task_id',
        'user_id',
        'accepted_by_user_id',
        'reason',
        'result',
        'from_time',
        'to_time',
        'request_time',
        'response_time',
        'status',
        'duration',

        'show',
        'sort',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            LogHistory::create([
                'user_id' => auth()->user() ? auth()->user()->id : 0,
                'action' => 'create',
                'by_model_name' => 'extra_time', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => 'task', // task, daily_task,
                'on_model_id' => $model->task_id, // task, daily_task,
                'preaf' => [
                    'en' => 'new extra time requested',
                ],
                'desc' => [
                    'en' => 'there is a new extra time requested on task - ' . $model->task_id,
                ],
            ]);
        });

        static::updating(function ($model) {
            // Check which attributes are being updated
            $dirtyAttributes = $model->getDirty();

            // Get the old values for the updated attributes
            $oldValues = [];
            foreach ($dirtyAttributes as $attribute => $value)
                $oldValues[$attribute] = $model->getOriginal($attribute);

            LogHistory::create([
                'user_id' => auth()->user() ? auth()->user()->id : 0,
                'action' => 'update',
                'by_model_name' => 'extra_time', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => 'task', // task, daily_task,
                'on_model_id' => $model->task_id, // task, daily_task,
                'from_data' => $oldValues,
                'to_data' => $dirtyAttributes,
                'preaf' => [
                    'en' => 'the extra time updated',
                ],
                'desc' => [
                    'en' => 'there is update on extra time at task - ' . $model->task_id,
                ],
                // 'color' => '',
            ]);
        });

        static::deleted(function ($model) {
            LogHistory::create([
                'user_id' => auth()->user() ? auth()->user()->id : 0,
                'action' => 'delete',
                'by_model_name' => 'extra_time', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => 'task', // task, daily_task,
                'on_model_id' => $model->task_id, // task, daily_task,
                'preaf' => [
                    'en' => 'extra time deleted',
                ],
                'desc' => [
                    'en' => 'extra time deleted from task - ' . $model->task_id,
                ],
            ]);
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


            $q->orWhere('task_id', $search);
            $q->orWhere('user_id', $search);
            $q->orWhere('accepted_by_user_id', $search);
            $q->orWhereSearch('reason', $search);
            $q->orWhereSearch('result', $search);
            $q->orWhereSearch('request_time', $search);
            $q->orWhereSearch('from_time', $search);
            $q->orWhereSearch('to_time', $search);
            $q->orWhereSearch('response_time', $search);
            $q->orWhereSearch('status', $search);
            $q->orWhereSearch('duration', $search);

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



    public function task()
    {
        return $this->belongsTo(Task::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function accepted_by_user()
    {
        return $this->belongsTo(User::class, 'accepted_by_user_id');
    }

    public function format_date($data)
    {
        return date('Y-m-d h:i A', strtotime($data));
    }


    public function the_extra_color()
    {
        if ($this->status == 'pending')
            return 'btn-outline-warning';
        elseif ($this->status == 'accepted')
            return 'btn-outline-success';
        elseif ($this->status == 'rejected')
            return 'btn-outline-danger';

        return '';
    }

    public function the_status()
    {
        if ($this->status == 'pending')
            return __('extratime.pending');
        elseif ($this->status == 'accepted')
            return __('extratime.accepted');
        elseif ($this->status == 'rejected')
            return __('extratime.rejected');

        return '';
    }

    public function getDurationAttribute()
    {
        return $this->the_duration();
    }

    public function getDurationInSecAttribute()
    {
        return $this->the_duration_in_sec();
    }

    public function the_duration()
    {
        $totalSeconds = $this->the_duration_in_sec();
        // Convert seconds to hours and minutes
        $hours = intval($totalSeconds / 3600);
        $minutes = intval(($totalSeconds % 3600) / 60);
        // 
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $result = $hours_string . ':' . $minutes_string . ':00';
        return $result;
    }

    public function the_duration_in_sec()
    {
        $startDate = Carbon::parse(date('Y-m-d h:i:s', strtotime($this->from_time)));
        $endDate = Carbon::parse(date('Y-m-d h:i:s', strtotime($this->to_time)));

        $totalSeconds = $endDate->diffInSeconds($startDate);

        return $totalSeconds;
    }
}
