<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method get()
 * @method create(array $datForm)
 * @method find(int $id)
 */
class UsersToConstructions extends Model
{
    protected $fillable = [
        'user',
        'construction'
    ];
}
