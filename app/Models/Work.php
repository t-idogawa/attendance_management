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

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
