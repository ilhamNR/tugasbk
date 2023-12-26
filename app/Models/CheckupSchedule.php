<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $doctor_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 * @property Doctor $doctor
 * @property PoliRegistrant[] $poliRegistrants
 */
class CheckupSchedule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['doctor_id', 'day', 'start_time', 'end_time', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poliRegistrants()
    {
        return $this->hasMany('App\Models\PoliRegistrant');
    }
}
