<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Login extends Controller
{
    public function fetch_auth_user(Request $request)
    {
        return response()->json(["message"=>"successful","data"=>Auth::user()]); 
    }

    public function login(Request $request)
    {

       if(! $loign = Auth::attempt($request->only("email","password"))) {
            return response()->json(["message"=>"login error","data"=>$loign], Response::HTTP_UNAUTHORIZED);
       }

       $user = Auth::user();
       $token = $user->createToken('token')->plainTextToken;
       $cookie = cookie('jwt', $token, 60 * 24);

       return response()->json(["message"=>"login successful","data"=>$token])->withCookie($cookie);
        
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response()->json(['message'=>'logut successful'])->withCookie($cookie);
    }
}
