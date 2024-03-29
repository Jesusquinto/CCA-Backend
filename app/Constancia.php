<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class Constancia extends Model implements AuthenticatableContract, AuthorizableContract
{
    

    protected $table = 'constancias';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','aprendiz','pathway', 'descripcion', 'imagenes', 'estado', 'ficha', 'instructor'
            ];
    protected $hidden = [

    ];

   //Una reserva pertenece a una cancha
    public function pathway()
    {
    	return $this->belongsTo(Pathway::class, 'pathway');
    }

  



}
