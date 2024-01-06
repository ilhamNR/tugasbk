<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property integer $price
 * @property string $created_at
 * @property string $updated_at
 * @property CheckupDetail[] $checkupDetails
 */
class Medicine extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'unit', 'price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkupDetails()
    {
        return $this->hasMany('App\Models\CheckupDetail');
    }
}
