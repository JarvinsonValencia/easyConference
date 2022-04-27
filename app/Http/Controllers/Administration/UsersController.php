<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;


class UsersController extends Controller
{
    public function getListUsers(Request $request){
        try {
            if($request->ajax()){
                return User::all();
            } 
        }catch(Throwable $e){
            report($e);
            return $e;
        }
        
    }

    public function getUser($id) {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        }catch(Throwable $e){
            report($e);
            return $e;
        }
    }

    public function setCreateUser(Request $request) {
       
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'document' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/user/create')
                ->withErrors($validator)
                ->withInput();
            }else {
                $record = new User();
                $record->name = $request->name;
                $record->document = $request->document;
                $record->phone = $request->phone;
                $record->email = $request->email;
                $record->username = $request->username;
                $record->password = bcrypt($request->password);
                $record->save();
               
            }
        }catch(Throwable $e){
            report($e);
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
            $record->save();
    
            return response()->json($record);
        }catch(Throwable $e){
            report($e);
            return $e;
        }
    }
}
