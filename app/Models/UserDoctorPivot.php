<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $poli_id
 * @property string $address
 * @property string $no_hp
 * @property string $created_at
 * @property string $updated_at
 * @property Poli $poli
 * @property User $user
 */
class UserDoctorPivot extends Model
{
    /**
     * @var array
     */
    protected $table = "user_doctor_pivot";
    protected $fillable = ['user_id', 'poli_id', 'address', 'no_hp', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poli()
    {
        return $this->belongsTo('App\Models\Poli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
