<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class Nodo extends Model implements AuthenticatableContract, AuthorizableContract
{
    

    protected $table = 'nodos';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','nombre', 'estado'
            ];
    protected $hidden = [

    ];

   //Una reserva pertenece a una cancha
    public function cancha()
    {
    	return $this->belongsTo(Cancha::class);
    }


    //Una reserva pertenece a un establecimiento
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);

    }

    //Una reserva pertenece a un usuario
    public function usuario()
    {
    	return $this->belongsTo(Usuario::class);
    }




}
