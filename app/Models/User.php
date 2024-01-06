<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property UserDoctorPivot[] $userDoctorPivots
 * @property CheckupSchedule[] $checkupSchedules
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userDoctorPivots()
    {
        return $this->hasMany('App\Models\UserDoctorPivot');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkupSchedules()
    {
        return $this->hasMany('App\Models\CheckupSchedule');
    }
}
