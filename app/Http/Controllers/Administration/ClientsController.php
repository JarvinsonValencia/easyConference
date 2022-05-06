<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Exception;
use Throwable;

class ClientsController extends Controller
{
    public function getListClients(Request $request){
        try {
            if($request->ajax()){
                return Client::all();
            } 
        }catch(Throwable $e){
            return $e;
        }
        
    }

    public function setCreateClient(Request $request) {
        try {
            $client = new Client();
            $client->name = $request->name;
            $client->document = $request->document;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->address = $request->address;
            
            $client->save();
            return response()->json($client);
        }catch (Exception $e) {
            return $e;
        }

    }

    public function deleteClient($id) {
        try {
             $user = Client::findorFail($id);
             $user->delete();
        }catch(Exception $e) {
            return $e;
        }
     }
     
}
