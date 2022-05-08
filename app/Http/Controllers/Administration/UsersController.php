<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
Use Exception;


class UsersController extends Controller
{
    public function getListUsers($role_id, $client_id){
        try {   
            $listUsers = array();
            $user = User::all();
            $rol = Rol::all();

                foreach($user as $u) {
                    try {
                        if ($role_id == 1) {
                            $rol = Rol::find($u->role_id);
                            $u->role_id = $rol->name;
                            array_push($listUsers, $u); 
                        }
                        else if($u->client_id == $client_id) {
                            $rol = Rol::find($u->role_id);
                            $u->role_id = $rol->name;
                            array_push($listUsers, $u);  
                        }
                    }catch(Exception $e) {
                        return $e;
                    }
                }
                return $listUsers;
        }catch(Exception $e){
            return $e;
        }  
    }

    public function getUser($id) {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        }catch(Exception $e){
            report($e);
            return $e;
        }
    }

    public function setCreateUser(Request $request) {
       
        try {
                $record = new User();
                $record->name = $request->name;
                $record->document = $request->document;
                $record->phone = $request->phone;
                $record->email = $request->email;
                $record->username = $request->username;
                $record->password = bcrypt($request->password);
                $record->role_id = $request->role_id;
                $record->client_id = $request->client_id;
                $record->save();
                return response()->json($record);
        }catch(Exception $e){
            //report($e);
            return $e;
        }
    }

    public function editUser(Request $request, $id) {
        try {
            $record = User::findOrFail($id);
            $record->name = $request->name;
            $record->document = $request->document;
            $record->phone = $request->phone;
            $record->email = $request->email;
            $record->username = $request->username;
            $record->password = bcrypt($request->password);
            $record->role_id = $request->role_id;
            $record->client_id = $request->client_id;
            $record->save();
    
            return response()->json($record);
        }catch(Exception $e){
            return $e;
        }
    }

    public function deleteUser($id) {
       try {
            $user = User::findorFail($id);
            $user->delete();
       }catch(Exception $e) {
           return $e;
       }
    }
}
