<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find($upload_type)
 * @method get()
 */
class UploadType extends Model
{
    protected $fillable = [
        'name','status'
    ];
}
