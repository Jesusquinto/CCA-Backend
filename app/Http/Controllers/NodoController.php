<?php

namespace App\Http\Controllers;
use App\Nodo;
use App\Aprendices;
use App\Ficha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class NodoController extends Controller
{


      //metodo listar canchas por establecimiento
     function get_nodos(){
      $nodos = Nodo::get();
      return response()->json($nodos);
   }


   function activar_desactivar_nodo($id){
    $nodo = Nodo::find($id);

    if($nodo->estado == 0){
       $nodo->estado = 1;
    }else{
       $nodo->estado = 0;
    }   
    $nodo->save();


    return response()->json([
       'success' => [
          'title'=> 'success',
           'code' => 200,
           'message' => "Datos actualizados correctamente",
       ]
       ], 200);
    
 }


 function crear_nodo(Request $request){
  $this->validate($request, [
    'nombre'    => 'required|email|max:65'
    
]);



   $data = $request;
   if($nodo = Nodo::create([
      'nombre' => $data['nombre'],
      'estado' => 0
   ])){
             return response()->json([
                'success' => [
                   'title'=> 'success',
                    'code' => 200,
                    'message' => "El nodo ".$data['nombre']." fué creado con exíto",
                ]
              ], 200);
          }
   }
 

  












 }



     



   

