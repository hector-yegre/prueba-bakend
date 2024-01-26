<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthConttroller extends Controller
{
    //

    public function login(UserPostRequest $request){


        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'err'=>"Unauthorized",
                'msg'=>'Usuario o contraseña invalido'
            ],401);
        }

        $user = User::where('email',"$request->email")->firstOrFail();
        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'msg'=>'Logeado',
            'token'=>$token,
            'token_type'=>'bearer',
            'user'=>$user
        ]);
    }

    public function logout(Request $request){

        // auth()->user()->tokens()->delete();
        auth()->user()->tokens()->delete();
        return response()->json([
            'ok'=>true,
            'msg'=>'Exit Todos los token han sido borrados'
        ],200);
    }
    
    public function sheck(){
        if(Auth::check()){
            return response()->json([
                'ok'=>true,
            ],200);
        } 
           

       
    }
}
