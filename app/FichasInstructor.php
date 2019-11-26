<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class FichasInstructor extends Model implements AuthenticatableContract, AuthorizableContract
{
    

    protected $table = 'fichas_instructores';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','instructor', 'ficha'
            ];
    protected $hidden = [

    ];

   //Una reserva pertenece a una cancha
    public function ficha()
    {
    	return $this->belongsTo(Ficha::class, 'ficha');
    }


   


}
