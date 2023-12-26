<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $no_ktp
 * @property string $no_hp
 * @property string $no_rm
 * @property string $created_at
 * @property string $updated_at
 * @property PoliRegistrant[] $poliRegistrants
 */
class Patient extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'address', 'no_ktp', 'no_hp', 'no_rm', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poliRegistrants()
    {
        return $this->hasMany('App\Models\PoliRegistrant');
    }
}
