<?php

namespace App\Models;

use App\Models\Responsible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method find(int $id)
 * @method create(array $datForm)
 * @method get()
 */
class Construction extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' ,
        'thumbnail',
        'company' ,
        'responsible' ,
        'contract_regime' ,
        'reporting_regime' ,
        'issuance_date' ,
        'work_number' ,
        'status' ,
        'address',
    ];

    public function responsibles()
    {
        return $this->hasOne(Responsible::class,'id','responsible');
    }

    public function address()
    {
        return $this->hasOne(Address::class,'id','address');
    }

    public function clients()
    {
        return $this->belongsToMany(User::class,'users_to_constructions','user');
    }
}
