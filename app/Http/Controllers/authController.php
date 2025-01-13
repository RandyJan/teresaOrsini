<?php

namespace App\Http\Controllers;

use App\Models\users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class authController extends Controller
{
    //
    public function signin(Request $request){
        
       try{
        $validate = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|string'
        ]);
       }
       catch(ValidationException $val){
        return response()->json([
            'StatuCode'=>404,
            'message'=>'invalid input',
            'data'=>$val->errors()
        ],404);
       }
        try{
            
            $result = users::create(
                $validate
            );
        }
        catch(Exception $e){
            return response()->json(['StatusCode'=>500,
            'message'=>'Attempt failed',
        'data'=>$e],500);

        }

        if($result){
            return response()->json(['StatusCode'=>200,
            'message'=>'Account created successfully'],200);

        }
    }
    public function login(Request $request){
        $result = users::select()->where('email',$request['email'])
        ->where('password',$request['password'])->first();
        if($result){
            return response()->json(['StatusCode'=>200,
            'message'=>"Login success",
            'data'=>$result]);
        }
        return response()->json(['StatusCode'=>404,
    'message'=>"Login error",
    'data'=>$request],404);
    }
}
