<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function setCreatePerson(Request $request) {
       
            $record = new User();
            $record->name = $request->name;
            $record->lastname = $request->lastname;
            $record->username = $request->username;
            $record->email = $request->email;
            $record->password = bcrypt($request->password);
            $record->save();
        
       
        
        return $record;
    }

    public function editPerson(Request $request, $id) {
        $record = User::findOrFail($id);
        $record->name = $request->name;
        $record->lastname = $request->lastname;
        $record->username = $request->username;
        $record->email = $request->email;
        $record->password = $record->password = bcrypt($request->password);

        $record->save();

        return response()->json($record);
    }
}
