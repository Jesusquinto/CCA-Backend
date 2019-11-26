<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use App\Aprendices;
use App\Ficha;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Usuario extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    protected $table = 'usuarios';

    use Authenticatable, Authorizable;

    protected $fillable = [
        'id','nombre','apellido','tipo_identificacion','email','password','rol','identificacion'
            ];
    protected $hidden = [
        'password'

    ];

    public function Rol(){
        return $this->belongsTo(Rol::class, 'rol');

    }



    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {

        if($this->rol == 3){
            return [
                'id'=> $this->id,
                'nombre'=> $this->nombre,
                'apellido'=> $this->apellido,
                'email'=> $this->email,
                'identificacion'=> $this->identificacion,
                'tipo_identificacion'=> $this->tipo_identificacion,
                'rol'=> $this->rol,
                'ficha'=> Ficha::where('id',Aprendices::where('usuario', $this->id)->get()[0]->ficha)->get(),
            ];
        }



        if($this->rol == 2){
            return [
                'id'=> $this->id,
                'nombre'=> $this->nombre,
                'apellido'=> $this->apellido,
                'email'=> $this->email,
                'identificacion'=> $this->identificacion,
                'tipo_identificacion'=> $this->tipo_identificacion,
                'rol'=> $this->rol,
                'fichas'
            ];
        }


        if($this->rol == 1){
            return [
                'id'=> $this->id,
                'nombre'=> $this->nombre,
                'apellido'=> $this->apellido,
                'email'=> $this->email,
                'identificacion'=> $this->identificacion,
                'tipo_identificacion'=> $this->tipo_identificacion,
                'rol'=> $this->rol
            ];
        }



    }

}
