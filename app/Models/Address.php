<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method find(int $id)
 * @method static create(array $dataAddress)
 */
class Address extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street','number','location','status',
    ];

    public function location()
    {
        return $this->hasOne(Location::class,'location');
    }
}
