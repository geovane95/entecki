<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method pluck(string $string, string $string1)
 * @method find($profile)
 * @method get()
 */
class AccessProfile extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class,'access_profile');
    }
}
