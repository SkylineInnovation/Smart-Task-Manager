<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

// use Laratrust\Traits\LaratrustUserTrait;

class LogHistory extends Model
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
        'action',
        'by_model_name', // attachment, comment, extra_time, leave,
        'by_model_id', // attachment, comment, extra_time, leave,
        'on_model_name', // task, daily_task,
        'on_model_id', // task, daily_task,
        'from_data',
        'to_data',
        'preaf',
        'desc',
        'color',

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

        'preaf' => 'json',
        'desc' => 'json',

        'from_data' => 'json',
        'to_data' => 'json',
    ];

    public function crud_name()
    {
        return $this->id;
    }

    public function the_preaf($lang = null)
    {
        return $this->translateCol($this->preaf, $lang);
    }

    public function the_desc($lang = null)
    {
        return $this->translateCol($this->desc, $lang);
    }

    public static function livewireSearch($search)
    {
        $qqq = static::query();

        // if (!auth()->user()->hasRole(['owner', 'manager'])) {
        //     $qqq = $qqq->where('add_by', auth()->user()->id);
        // }

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->whereIn('id', array_map('intval', explode(',', $search)));


            // $q->orWhere('user_id', $search);
            // $q->orWhereSearch('action', $search);
            // $q->orWhereSearch('by_model_name', $search);
            // $q->orWhereSearch('by_model_id', $search);
            // $q->orWhereSearch('on_model_name', $search);
            // $q->orWhereSearch('on_model_id', $search);
            // $q->orWhereSearch('from_data', $search);
            // $q->orWhereSearch('to_data', $search);
            $q->orWhereSearch('preaf', $search);
            $q->orWhereSearch('desc', $search);
            // $q->orWhereSearch('color', $search);

        })->orWhereHas('user', function ($q) use ($search) {
            $q->orWhereSearch('first_name', $search);
            $q->orWhereSearch('last_name', $search);
            $q->orWhereRaw('concat(first_name, " ", last_name) like "%' . $search . '%"');
            $q->orWhereSearch('email', $search);
            $q->orWhereSearch('phone', $search);
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

    public function from_readable()
    {
        $data = $this->from_data;
        if (!$data) return '';

        $formatted_data = "";
        foreach ($data as $key => $value) {
            if (str_contains($key, 'time')) {
                $formatted_data .= "$key: " . date('Y-m-d H:i', strtotime($value)) . " <br>";
            } else {
                $formatted_data .= "$key: $value <br>";
            }
        }

        return trim($formatted_data);
    }

    public function to_readable()
    {
        $data = $this->to_data;
        if (!$data) return '';

        $formatted_data = "";
        foreach ($data as $key => $value) {
            if (str_contains($key, 'time')) {
                $formatted_data .= "$key: " . date('Y-m-d H:i', strtotime($value)) . " <br>";
            } else {
                $formatted_data .= "$key: $value <br>";
            }
        }

        return trim($formatted_data);
    }

    public function readable()
    {
        $from_data = $this->from_data;
        $to_data = get_object_vars($this->to_data);

        if (!$from_data || $to_data) return '';

        $formatted_data = "";
        foreach ($from_data as $key => $value) {
            if ($key != 'order_status_id') {
                $key_text = str_replace('_', ' ', $key);
                $ftom_val = $value ?? '--';

                if (str_contains($key, 'time')) {
                    $formatted_data .= "$key_text: " . date('Y-m-d H:i', strtotime($ftom_val)) . " -> " . date('Y-m-d H:i', strtotime($to_data[$key])) . "<br>";
                } else {
                    $formatted_data .= "$key_text: $ftom_val -> " . $to_data[$key] . "<br>";
                }
            }
        }

        return $formatted_data;
    }

    public function colors()
    {
        $ownerExists = $this->user->hasRole('owner');
        $employeeExists = $this->user->hasRole('employee');
        $managerExists = $this->user->hasRole('manager');

        if ($ownerExists)
            return '<span class="dot-label mx-2"
                style="background-color: #F82649;">
            </span> Owner'; // Set color for owner



        if ($employeeExists)
            return '<span class="dot-label mx-2"
                style="background-color: #F7B731;">
            </span> Employee'; // Set color for employee

        if ($managerExists)
            return '<span class="dot-label mx-2"
                style="background-color:rgb(49, 247, 122);">
            </span> Manager'; // Default case if no owner or employee role found


        return '';
    }
}
