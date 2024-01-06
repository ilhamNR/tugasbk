<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $poli_name
 * @property string $details
 * @property string $created_at
 * @property string $updated_at
 * @property Doctor[] $doctors
 */
class Poli extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['poli_name', 'details', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }
}
