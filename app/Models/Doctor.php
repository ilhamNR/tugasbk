<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $poli_id
 * @property string $name
 * @property string $address
 * @property string $no_hp
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Poli $poli
 */
class Doctor extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['poli_id', 'name', 'address', 'no_hp', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poli()
    {
        return $this->belongsTo('App\Models\Poli');
    }
}
