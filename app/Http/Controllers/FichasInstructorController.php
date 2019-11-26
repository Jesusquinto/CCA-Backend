<?php

namespace App\Http\Controllers;
use App\Pathway;
use App\Instructores;
use App\FichasInstructor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class FichasInstructorController extends Controller
{


     function get_pathways(){
      $pathways = Pathway::get();
      return response()->json($pathways);
   }


   function get_user_pathways(){
    $user = JWTAuth::parseToken()->authenticate(); 
    $aprendiz = Aprendices::where('usuario',$user->id)->first();
    $pathways = DB::select('SELECT * FROM pathways WHERE id NOT IN (SELECT pathway FROM constancias WHERE aprendiz = '.$aprendiz->id.' AND  estado <> 4)');
    return response()->json($pathways);

   }


   function get_instructor_fichas(){
    $user = JWTAuth::parseToken()->authenticate();
    if($user->rol == 2){
      $instructor = Instructores::where('usuario',$user->id)->first();
      $Fichas = FichasInstructor::with('ficha')->where('instructor', $instructor->id)->get();
      return response()->json($Fichas);
    }
    
   }



 }



     



   

