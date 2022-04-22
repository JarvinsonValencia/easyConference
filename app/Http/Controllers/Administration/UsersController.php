<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function getListUsers(Request $request){
        if($request->ajax()){
            return User::all();
        }
    }

    public function getUser($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function setCreateUser(Request $request) {
       
            $record = new User();
            $record->name = $request->name;
            $record->document = $request->document;
            $record->phone = $request->phone;
            $record->email = $request->email;
            $record->username = $request->username;
            $record->password = bcrypt($request->password);
            $record->save();
        
       
        return $record;
    }

    public function editUser(Request $request, $id) {
        $record = User::findOrFail($id);
        $record->name = $request->name;
        $record->document = $request->document;
        $record->phone = $request->phone;
        $record->email = $request->email;
        $record->username = $request->username;
        $record->password = bcrypt($request->password);
        $record->save();

        $record->save();

        return response()->json($record);
    }
}
