<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        // $email = $request->email;
        // $password = $request->password;
        $credentials = $request->only('email', 'password');

        $rpta = Auth::attempt($credentials);
       
        if ($rpta) {
            request()->session()->regenerate();
            return response()->json([
                'authUser'  =>  Auth::user(),
                'code'      =>  200
            ]);
        } else {
            return response()->json([
                'code' =>  401
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'code' =>  204
        ]);
    }
}
