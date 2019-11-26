<?php

namespace App\Http\Controllers;
use App\Pathway;
use App\Aprendices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class PathwayController extends Controller
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



 }



     



   

