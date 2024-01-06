<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $checkup_id
 * @property integer $medicine_id
 * @property string $created_at
 * @property string $updated_at
 * @property Medicine $medicine
 * @property Checkup $checkup
 */
class CheckupDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['checkup_id', 'medicine_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkup()
    {
        return $this->belongsTo('App\Models\Checkup');
    }
}
