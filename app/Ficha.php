<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class Ficha extends Model implements AuthenticatableContract, AuthorizableContract
{
    

    protected $table = 'fichas';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','nombre','acronimo', 'nodo'
            ];
    protected $hidden = [

    ];

   
    public function nodo(){
        return $this->belongsTo(Nodo::class, 'nodo');

    }



}
