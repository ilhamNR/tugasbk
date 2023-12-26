<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $patient_id
 * @property integer $checkup_schedule_id
 * @property string $complaints
 * @property integer $queue_number
 * @property string $created_at
 * @property string $updated_at
 * @property Checkup[] $checkups
 * @property Patient $patient
 * @property CheckupSchedule $checkupSchedule
 */
class PoliRegistrant extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'checkup_schedule_id', 'complaints', 'queue_number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkups()
    {
        return $this->hasMany('App\Models\Checkup', 'checkup_register_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkupSchedule()
    {
        return $this->belongsTo('App\Models\CheckupSchedule');
    }
}
