<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;
use Throwable;

class RolesController extends Controller
{
    public function getListRoles(Request $request){
        try {
            if($request->ajax()){
                $rol = Rol::all();
                    return $rol;
            } 
        }catch(Throwable $e){
            //report($e);
            return $e;
        }
        
    }
}
