<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'gender',
        'email',
        'phone',
        'birthday',
        'post_code',
        'address',
        'hire_date',
        'store_id',
        'post_number',
        'license_flg',
        'hourly_pay',
        'password',
        'created_account_id',
        'created_at',
        'updated_account_id',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function monthSalaries()
    {
        return $this->hasMany(MonthSalary::class);
    }
}
