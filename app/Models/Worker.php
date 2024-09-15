<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rorecek\Ulid\HasUlid;

class Worker extends Model
{
    use HasFactory, SoftDeletes, HasUlid;

    public $incrementing = false;
    
    protected $keyType = 'string';

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function monthSalaries()
    {
        return $this->hasMany(MonthSalary::class);
    }
}
