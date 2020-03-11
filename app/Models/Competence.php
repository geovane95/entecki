<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method get()
 * @method create(array $datForm)
 * @method find(int $id)
 */
class Competence extends Model
{
    protected $fillable = ['description','month','year','status',];
}
