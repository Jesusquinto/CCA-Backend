<?php

namespace App\Http\Controllers;
use App\Constancia;
use App\Usuario;
use App\Aprendices;
use App\Instructores;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ConstanciaController extends Controller
{


      //metodo listar canchas por establecimiento
     function get_user_constancias(){
      $user = JWTAuth::parseToken()->authenticate(); 
      $aprendiz = Aprendices::where('usuario',$user->id)->first();
      $constancias = Constancia::with(['pathway'])->where('aprendiz', $aprendiz->id)->where('estado', '<>', 4)->get();
      foreach($constancias as $c){
         if($c->instructor != null){
            $c->instructor = Instructores::with(['usuario'])->where('id', $c->instructor)->first();
         }
      }
      return response()->json($constancias);
   }


   function get_constancias_instructor($pathway, $ficha){
      $constancias = Constancia::with(['pathway'])->where('pathway', $pathway)->where('estado', '<>', 4)->get();
         foreach ($constancias as $c) {   
            if($c->instructor != null){
               $c->instructor = Instructores::with(['usuario'])->where('id', $c->instructor)->first();
            }

            $c->aprendiz = Aprendices::with(['usuario'])->where('id',$c->aprendiz)->first();
      }

      $constancias_instructor = array();
      foreach ($constancias as $c) {
         if($c->aprendiz->ficha == $ficha){
            array_push($constancias_instructor, $c);
         }
      }



      return response()->json($constancias_instructor);
   }



   function set_estado_constacia(Request $request){
      $user = JWTAuth::parseToken()->authenticate(); 
      $instructor = Instructores::with(['usuario'])->where('usuario', $user->id)->first();
      $constancia = Constancia::where('id', $request->id)->first();
      $constancia->estado = $request->estado;
      $constancia->instructor = $instructor->id;
      $constancia->save();
      return response()->json([
         'success' => [
            'title'=> 'success',
             'code' => 200,
             'message' => "Constancia actualizada",
         ]
         ], 200
      );
   }


   function eliminarConstancia($id){
      $user = JWTAuth::parseToken()->authenticate(); 
      $aprendiz = Aprendices::where('usuario',$user->id)->first();
      $constancia = Constancia::where('aprendiz', $aprendiz->id)->where('id', $id)->first();
      $constancia->estado = 4;
      $constancia->save();
      return response()->json([
         'success' => [
            'title'=> 'success',
             'code' => 200,
             'message' => "Constancia Eliminada",
         ]
         ], 200);
   }



   function create_user_constancia(Request $request){
    $user = JWTAuth::parseToken()->authenticate(); 
    $aprendiz = Aprendices::where('usuario',$user->id)->first();
    $url = [];
    for ($i=0; $i < 4 ; $i++) {
        if($file = Input::file('image'.$i)){
          $datos = $file->getClientOriginalName();
          $datos = $splitName = explode('.', $datos, 3);
          $datos = $datos[sizeof($datos)-1];
          if($datos != 'jpg' ){
             return response()->json([
                'error' => [
                   'title'=> 'Error',
                    'code' => 400,
                    'message' => "La extension ".$datos." no es un formato disponible, solo jpg!",
                ]
                ], 400);
          }
          $random = str_random(10);
             $nombre = $random.'-'.$user->email.'-'.$file->getClientOriginalName();
             $path = rtrim(app()->basePath('public/' . 'uploads/'.$nombre), '/');
             array_push($url, $nombre);
             $image = Image::make($file->getRealPath());
             $image->save($path);

        }
    }

    $constancia = Constancia::create([
      'aprendiz' => $aprendiz->id,
      'pathway' => $request->pathway,
      'descripcion' => $request->descripcion,
      'imagenes' => json_encode($url),
      'estado' => 0,
      'ficha' => $aprendiz->ficha,
      
   ]);
   return response()->json([
      'success' => [
         'title'=> 'Genial',
          'code' => 201,
          'message' => "Constancia ".$request->nombre." creada con exito!",
      ]
      ], 201);


   }




















 }



     



   

