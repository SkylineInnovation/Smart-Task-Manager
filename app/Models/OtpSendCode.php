<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Laratrust\Traits\LaratrustUserTrait;

class OtpSendCode extends Model
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
        'otp_code',
        'phone_number',
        'applecation',
        'code_status',
        'back_response',

        'show',
        'sort',
    ];

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
    ];

    public function crud_name()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image != null ? asset($this->image) : null;
    }

    public static function livewireSearch($search)
    {
        $qqq = static::query();

        // if (!auth()->user()->hasRole(['owner',]))
        //     $qqq = $qqq->where('add_by', auth()->user()->id);

        if (empty($search)) return $qqq;

        return $qqq->where(function ($q) use ($search) {
            $q->whereIn('id', array_map('intval', explode(',', $search)));


            // $q->orWhere('user_id', 'like', $search);
            $q->orWhereSearch('otp_code', $search);
            $q->orWhereSearch('phone_number', $search);
            $q->orWhereSearch('applecation', $search);
            $q->orWhereSearch('code_status', $search);
            $q->orWhereSearch('back_response', $search);
        });
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
