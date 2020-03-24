<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method get()
 * @method create(array $datForm)
 * @method find($uploadDataId)
 */
class UploadData extends Model
{
    protected $fillable = [
        'user','accessprofile','linecount', 'uploadstatus', 'uploadtype','competence','upload_type','fileName','file','folder','construction', 'extension'

    ];
}
