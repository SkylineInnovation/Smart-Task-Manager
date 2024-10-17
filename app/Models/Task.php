<?php

namespace App\Models;

use App\Mail\Task\SendStatusChangeOnTask;
use App\Traits\TranslateTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

// use Laratrust\Traits\LaratrustUserTrait;

class Task extends Model
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
        'desc',
        'start_time',
        'end_time',
        'priority_level',
        'status',
        'main_task_id',
        'daily_task_id',
        'reopen_from_task_id',

        'show',
        'sort',
    ];

    protected static function boot()
    {
        parent::boot();

        // Mail::to([])->send(new SendNewTaskToEmployee($model));
        static::created(function ($model) {
            if ($model->main_task) {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'sub_task', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => 'task', // task, daily_task,
                    'on_model_id' => $model->main_task_id, // task, daily_task,
                    'preaf' => [
                        'en' => 'new sub task added',
                    ],
                    'desc' => [
                        'en' => 'there is a new sub task on task - ' . $model->main_task_id,
                    ],
                ]);
            } elseif ($model->daily_task) {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'daily_task', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => 'task', // task, daily_task,
                    'on_model_id' => $model->daily_task_id, // task, daily_task,
                    'preaf' => [
                        'en' => 'new task added by daily task',
                    ],
                    'desc' => [
                        'en' => 'there is a new task added by daily task - ' . $model->daily_task_id,
                    ],
                ]);
            } elseif ($model->reopen_from_task) {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'reopen_task', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => 'task', // task, daily_task,
                    'on_model_id' => $model->reopen_from_task_id, // task, daily_task,
                    'preaf' => [
                        'en' => 'task has opend',
                    ],
                    'desc' => [
                        'en' => 'there is task reopend again from task - ' . $model->reopen_from_task_id,
                    ],
                ]);
            } else {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'task', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => '', // task, daily_task,
                    'on_model_id' => 0, // task, daily_task,
                    'preaf' => [
                        'en' => 'new task added',
                    ],
                    'desc' => [
                        'en' => 'there is a new task - ' . $model->id,
                    ],
                ]);
            }
        });

        static::updating(function ($model) {
            // Check which attributes are being updated
            $dirtyAttributes = $model->getDirty();

            // Get the old values for the updated attributes
            $oldValues = [];
            foreach ($dirtyAttributes as $attribute => $value)
                $oldValues[$attribute] = $model->getOriginal($attribute);

            LogHistory::create([
                'user_id' => auth()->user()->id,
                'action' => 'update',
                'by_model_name' => 'task', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => '', // task, daily_task,
                'on_model_id' => 0, // task, daily_task,
                'from_data' => $oldValues,
                'to_data' => $dirtyAttributes,
                'preaf' => [
                    'en' => 'the task updated',
                ],
                'desc' => [
                    'en' => 'there is update on task - ' . $model->id,
                ],
                // 'color' => '',
            ]);

            // if (env('SEND_MAIL', false)) {
            //     if ($model->getOriginal()['status'] != $model->getAttributes()['status']) {
            //         $template = '';
            //         if ($model->status == 'active') {
            //             $template = 'active';
            //         } elseif ($model->status == 'auto-finished') {
            //             $template = 'auto-finished';
            //         } elseif ($model->status == 'manual-finished') {
            //             $template = 'manual-finished';
            //         }
            // 
            //         $mail_list = [
            //             $model->manager->email,
            //         ];
            // 
            //         foreach ($model->employees as $emp) {
            //             $mail_list[] = $emp->email;
            //         }
            // 
            //         if ($template != '')
            //             Mail::to($mail_list)->send(new SendStatusChangeOnTask($template, $model));
            //     }
            // }
        });

        static::deleted(function ($model) {
            LogHistory::create([
                'user_id' => auth()->user()->id,
                'action' => 'delete',
                'by_model_name' => 'task', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => '', // task, daily_task,
                'on_model_id' => 0, // task, daily_task,
                'preaf' => [
                    'en' => 'task deleted',
                ],
                'desc' => [
                    'en' => 'task deleted - ' . $model->id,
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
        return $this->title;
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


            // $q->orWhere('manager_id', $search);
            $q->orWhereSearch('title', $search);
            $q->orWhereSearch('desc', $search);
            $q->orWhereSearch('start_time', $search);
            $q->orWhereSearch('end_time', $search);
            $q->orWhereSearch('priority_level', $search);
            $q->orWhereSearch('status', $search);
            // $q->orWhere('main_task_id', $search);

            // })->orWhereHas('add_by_user', function ($q) use ($search) {
            //     $q->orWhereSearch('first_name', $search);
            //     $q->orWhereSearch('last_name', $search);
            //     $q->orWhereRaw('concat(first_name, " ", last_name) like "%' . $search . '%"');
            //     $q->orWhereSearch('email', $search);
            //     $q->orWhereSearch('phone', $search);
        });
    }

    public function the_priority_level()
    {
        if ($this->priority_level == 'low')
            return __('task.low');
        elseif ($this->priority_level == 'medium')
            return __('task.medium');
        elseif ($this->priority_level == 'high')
            return __('task.high');
        elseif ($this->priority_level == 'urgent')
            return __('task.urgent');

        return '';
    }

    public function the_priority_color()
    {
        if ($this->priority_level == 'low')
            return '#00FF00';
        elseif ($this->priority_level == 'medium')
            return '#0000FF';
        elseif ($this->priority_level == 'high')
            return '#FF0000';
        elseif ($this->priority_level == 'urgent') // TODO
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

    public function the_status_color()
    {
        if ($this->status == 'pending')
            return '#00FF00';
        elseif ($this->status == 'active')
            return '#0000FF';
        elseif ($this->status == 'auto-finished')
            return '#FF0000';
        elseif ($this->status == 'manual-finished') // TODO
            return '#FF0000';

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


    public function main_task()
    {
        return $this->belongsTo(Task::class, 'main_task_id');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class)->withPivot('discount');
    }

    public function discount()
    {
        return count($this->employees) > 0 ? $this->employees->first()->pivot->discount : 0;
    }

    public function format_date($data)
    {
        return date('Y-m-d h:i A', strtotime($data));
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('main_comment_id', 0);
    }

    public function sub_tasks()
    {
        return $this->hasMany(Task::class, 'main_task_id')->whereHas('manager', function ($q) {
            $q->whereRoleIs('manager');
            $q->orWhereRoleIs('owner');
        });
    }
    public function emp_sub_tasks()
    {
        return $this->hasMany(Task::class, 'main_task_id')->whereHas('manager', function ($q) {
            $q->whereRoleIs('employee');
        });
    }

    public function extra_times()
    {
        return $this->hasMany(ExtraTime::class);
    }

    public function leaves_times()
    {
        return $this->hasMany(Leave::class);
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
        $startDate = Carbon::parse(date('Y-m-d h:i:s', strtotime($this->start_time)));
        $endDate = Carbon::parse(date('Y-m-d h:i:s', strtotime($this->end_time)));

        $totalSeconds = $endDate->diffInSeconds($startDate);

        return $totalSeconds;
    }

    public function getRemainingTimeAttribute()
    {
        return $this->calculateRemainingTime();
    }

    public function calculateRemainingTime()
    {
        $startDate = Carbon::parse(date('Y-m-d h:i:s'));
        $endDate = Carbon::parse(date('Y-m-d h:i:s', strtotime($this->end_time)));

        if ($startDate > $endDate) return 1;

        $totalSeconds = $endDate->diffInSeconds($startDate);
        return $totalSeconds;
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function daily_task()
    {
        return $this->belongsTo(DailyTask::class);
    }

    public function reopen_from_task()
    {
        return $this->belongsTo(Task::class, 'reopen_from_task_id');
    }
}
