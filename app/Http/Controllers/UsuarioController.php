<?php

namespace App\Http\Controllers;
use App\usuario;
use App\Aprendices;
use App\Ficha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
class UsuarioController extends Controller
{
	 //metodo listar todas los usuarios
   function get_usuarios(){
       $usuario = usuario::all();
       return response()->json($usuario);
     }

     //Mtetodo obtener el usuario logueado
     function get_usuario(Request $request){
      $user = JWTAuth::parseToken()->authenticate();
      return response()->json($user);


      $usuario = usuario::find($user->id);
      return response()->json($usuario);
     }
     

     //metodo listar usuario por id
     function get_usuario_by_id($id){
        $usuario = usuario::find($id);
        return response()->json($usuario);
     }

     //medoto crear usuario----------------------------------
     function crear_usuario(Request $request){
      if(count(usuario::where('email',$request['email'])->get()) > 0){
         return response()->json([
            'error' => [
               'title'=> 'error',
                'code' => 400,
                'message' => "Ya existe un usuario con el mismo email",
            ]
            ], 400);
      }

      if(count(usuario::where('identificacion',$request['identificacion'])->get()) > 0){
         return response()->json([
            'error' => [
               'title'=> 'error',
                'code' => 400,
                'message' => "Ya existe un usuario con el mismo id",
            ]
            ], 400);
      }
      $this->validate($request, [
         'email'    => 'required|email|max:255',
         'password' => 'required',
         'nombre' => 'required|max:65',
         'apellido' => 'required|max:65',
         'identificacion' => 'required|max:11',
         'tipo_identificacion' => 'required',
         'ficha' => 'required'
     ]);



        $data = $request;
        if($usuario = usuario::create([
           'nombre' => $data['nombre'],
           'apellido' => $data['apellido'],
           'identificacion' => $data['identificacion'],
           'tipo_identificacion' => $data['tipo_identificacion'],
           'email' => $data['email'],
           'rol' => 3,
           'password' =>Hash::make( $data['password'])
        ])){

      
            if(count(Ficha::where('id',$data['ficha'])->get()) == 0){

               $usuario->delete();


               return response()->json([
                  'error' => [
                     'title'=> 'error',
                      'code' => 400,
                      'message' => "La ficha no existe",
                  ]
                  ], 400);
            }

    
              if( $aprendiz = Aprendices::create([
                  'ficha' => $data['ficha'],
                  'usuario' => $usuario['id'],
                  'estado' => 0
               ])){

                  return response()->json([
                     'success' => [
                        'title'=> 'success',
                         'code' => 200,
                         'message' => "El usuario fué creado con exíto",
                     ]
                     ], 200);
               }
        }
     }
   //--------------------------------------

      //medoto actualizar usuario logueado
    function actualizar_usuario(Request $request){
      $user = JWTAuth::parseToken()->authenticate();
      $usuario= Usuario::find($user->id);
      $usuario->nombre = $request->nombre;
      $usuario->apellido =  $request->apellido;
      $usuario->usuario = $request->usuario;
      $usuario->password = Hash::make( $request->password); 
      $usuario->save();
      return response()->json([
         'success' => [
            'title'=> 'Genial!',
             'code' => 200,
             'message' => "Datos actualizados correctamente",
         ]
         ], 200);
   
     }
     







    //medoto actualizar usuario admin
    function actualizar_usuario_admin(Request $request){
      $usuario= Usuario::find($request->id);
      $usuario->nombre = $request->nombre;
      $usuario->apellido =  $request->apellido;
      $usuario->usuario = $request->usuario;
      $usuario->password = $request->password; 
      $usuario->save();
      return response()->json([
         'success' => [
            'title'=> 'success',
             'code' => 200,
             'message' => "Datos actualizados correctamente",
         ]
         ], 200);
   
     }


     function usuarios_mas_frecuentes(){
            



     }




}
