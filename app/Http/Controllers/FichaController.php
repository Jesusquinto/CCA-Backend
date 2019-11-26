<?php

namespace App\Http\Controllers;
use App\Ficha;
use App\Aprendices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class FichaController extends Controller
{


      //metodo listar canchas por establecimiento
     function get_fichas_by_nodoid($nodoId){
      $nodos = Ficha::where('nodo', $nodoId)->get();
      return response()->json($nodos);
   }



   function get_user_ficha(){
    $user = JWTAuth::parseToken()->authenticate();
    $aprendiz = Aprendices::with('ficha')->where('usuario',$user->id)->first();
    $fichaynodo = Ficha::with('nodo')->where('id',$aprendiz->ficha)->first();
    return response()->json($fichaynodo);
   }


  













 }



     



   

