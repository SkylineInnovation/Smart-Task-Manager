<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Laratrust\Traits\LaratrustUserTrait;

class Comment extends Model
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
        'title',
        'desc',
        'replay_time',
        'main_comment_id',

        'show',
        'sort',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            if ($model->main_comment) {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'comment', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => 'task', // task, daily_task,
                    'on_model_id' => $model->task_id, // task, daily_task,
                    'preaf' => [
                        'en' => 'comment replay',
                    ],
                    'desc' => [
                        'en' => 'there is new replay on comment - ' . $model->task_id,
                    ],
                ]);
            } else {
                LogHistory::create([
                    'user_id' => auth()->user()->id,
                    'action' => 'create',
                    'by_model_name' => 'comment', // attachment, comment, extra_time, leave, 
                    'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                    'on_model_name' => 'task', // task, daily_task,
                    'on_model_id' => $model->task_id, // task, daily_task,
                    'preaf' => [
                        'en' => 'new comment',
                    ],
                    'desc' => [
                        'en' => 'there is new comment on task - ' . $model->task_id,
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
                'by_model_name' => 'comment', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => 'task', // task, daily_task,
                'on_model_id' => $model->task_id, // task, daily_task,
                'from_data' => $oldValues,
                'to_data' => $dirtyAttributes,
                'preaf' => [
                    'en' => 'comment updated',
                ],
                'desc' => [
                    'en' => 'there is new comment on task - ' . $model->task_id,
                ],
                // 'color' => '',
            ]);
        });

        static::deleted(function ($model) {
            LogHistory::create([
                'user_id' => auth()->user()->id,
                'action' => 'delete',
                'by_model_name' => 'comment', // attachment, comment, extra_time, leave, 
                'by_model_id' => $model->id, // attachment, comment, extra_time, leave, 
                'on_model_name' => 'task', // task, daily_task,
                'on_model_id' => $model->task_id, // task, daily_task,
                'preaf' => [
                    'en' => 'comment deleted',
                ],
                'desc' => [
                    'en' => 'delete comment from task - ' . $model->task_id,
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
            $q->orWhereSearch('title', $search);
            $q->orWhereSearch('desc', $search);
            $q->orWhereSearch('replay_time', $search);
            $q->orWhere('main_comment_id', $search);

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


    public function main_comment()
    {
        return $this->belongsTo(Comment::class, 'main_comment_id');
    }

    public function subs()
    {
        return $this->hasMany(Comment::class, 'main_comment_id')->orderBy('id');
    }
}
