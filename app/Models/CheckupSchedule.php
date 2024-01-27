<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 * @property PoliRegistrant[] $poliRegistrants
 * @property User $user
 */
class CheckupSchedule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'day', 'start_time', 'end_time','is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poliRegistrants()
    {
        return $this->hasMany('App\Models\PoliRegistrant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
