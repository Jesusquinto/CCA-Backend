<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Aprendices extends Model implements AuthenticatableContract, AuthorizableContract
{

    protected $table = 'aprendices';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','ficha','usuario','estado'
            ];
    protected $hidden = [
    ];


    //Una cancha pertenece a un establecimiento
    public function usuario()
    {
    	return $this->belongsTo(usuario::class, 'usuario');
    }

    public function ficha(){
        return $this->belongsTo(Ficha::class, 'ficha');
    }

    //Una cancha pertenece a una cancha destacada
    public function canchas_destacadas()
    {
    	return $this->belongsTo(CanchasDestacadas::class, 'id');
    }


    //Una cancha tiene varias reservas
    public function reserva()
    {
    	return $this->hasMany(Reserva::class);
    }
   


}
