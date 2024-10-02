<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rorecek\Ulid\HasUlid;

class Work extends Model
{
    use HasFactory, SoftDeletes, HasUlid;

    public $incrementing = false;
    
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'start_work_time',
        'end_work_time',
        'start_break_time',
        'end_break_time',
        'created_account_id',
        'created_at',
        'updated_account_id',
        'updated_at',
    ];

    protected $casts = [
        'start_work_time' => 'datetime',
        'end_work_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
