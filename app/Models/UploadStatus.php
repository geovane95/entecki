<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find($upload_status)
 */
class UploadStatus extends Model
{
    protected $fillable = ['name','status'];
}
