<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static paginate()
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static get()
 */
class City extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','state','status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class,'state');
    }
}
