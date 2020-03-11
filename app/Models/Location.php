<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find($idLocation)
 * @method create(array $dataLocation)
 */
class Location extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'neighborhood','zipCode','city','status',
    ];

    public function city()
    {
        return $this->hasOne(City::class,'city');
    }
}
