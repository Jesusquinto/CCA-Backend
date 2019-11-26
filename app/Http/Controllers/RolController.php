<?php

namespace App\Http\Controllers;
use App\Rol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
class RolController extends Controller
{


      //metodo listar canchas por establecimiento
     function get_rol($id){
      $rol = Rol::where('id', $id)->first();
      return response()->json($rol);
   }













 }



     



   

