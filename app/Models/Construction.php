<?php

namespace App\Models;

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
        'business' ,
        'responsible' ,
        'cnpj' ,
        'regional' ,
        'contract_regime' ,
        'reporting_regime' ,
        'work_number' ,
        'status' ,
        'address',
    ];

    public function business()
    {
        return $this->hasOne(Business::class,'id','business');
    }

    public function regionals()
    {
        return $this->hasOne(Regional::class,'id','regional');
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
