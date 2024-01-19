<?php

namespace App\Http\Controllers\Api;


use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(),[
        'email' => 'required',
        'password' => 'required'
        ]);

        //jika validation gagal
        if($validator->fails()){
            return response();
        }

        //dapat credentials dari request
        $credentials = $request->only('email','password');

        //jika auth gagal
        if(!$token =JWTAuth::attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'email atau password salah'
            ], 401);
        }

        $user = auth()->user();
        return response()->json([
            'success' => true,
            'user' => auth()->user(),
            'role' => $user->role,
            'token' => $token
        ], 200);
    }
}
