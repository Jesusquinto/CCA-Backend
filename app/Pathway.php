<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class Pathway extends Model implements AuthenticatableContract, AuthorizableContract
{
    

    protected $table = 'Pathways';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','nombre','descripcion', 'imagen'
            ];
    protected $hidden = [

    ];

  




}
