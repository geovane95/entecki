<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method get()
 * @method create(array $data)
 * @method find(int $id)
 */
class State extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','initials','status',
    ];

    //relationship
    public function cities()
    {
        return $this->hasMany(City::class,'state');
    }
}
