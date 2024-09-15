<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rorecek\Ulid\HasUlid;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory, SoftDeletes, HasUlid;

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        // 新しいモデル作成時に ULID を生成
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::ulid();
            }
        });
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
