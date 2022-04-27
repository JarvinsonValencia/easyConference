<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Throwable;

class ClientsController extends Controller
{
    public function getListClients(Request $request){
        try {
            if($request->ajax()){
                return Client::all();
            } 
        }catch(Throwable $e){
            report($e);
            return $e;
        }
        
    }
}
