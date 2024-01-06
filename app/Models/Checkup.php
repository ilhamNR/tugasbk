<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $checkup_register_id
 * @property string $checkup_date
 * @property string $details
 * @property integer $cost
 * @property string $created_at
 * @property string $updated_at
 * @property CheckupDetail[] $checkupDetails
 * @property PoliRegistrant $poliRegistrant
 */
class Checkup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['checkup_register_id', 'checkup_date', 'details', 'cost', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkupDetails()
    {
        return $this->hasMany('App\Models\CheckupDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poliRegistrant()
    {
        return $this->belongsTo('App\Models\PoliRegistrant', 'checkup_register_id');
    }
}
