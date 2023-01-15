<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class Register extends Controller
{
    public function new_user(Request $request)
    {
       
       try {
                 $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
       } catch (\Illuminate\Validation\ValidationException $th) {
        return response()->json([
                    "message"=>"validation erorr",
                    "data"=>$th->errors()
        ],422) ;
       }

       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "message"=>"User registered",
            "data"=>$user
        ], ) ;
    }
}
