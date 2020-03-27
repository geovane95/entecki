<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method create(array $datForm)
 * @method find(int $id)
 * @method get()
 */
class Regional extends Model
{
    protected $fillable = [
        'name','status',
    ];
}
