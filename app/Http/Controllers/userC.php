<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class userC extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token=$user->createToken('myToken')->plainTextToken;

        return response([
            'Message' => "Thank You Registration",
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'Message' => "You have successfully logged out",
        ]);
    }

    public function login(Request $request)
    {
    $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);

    $user=User::where('email',$request->email)->first();

    if($user && (Hash::check($request->password,$user->password)))
    {
        $token=$user->createToken('myToken')->plainTextToken;
        return response([
            'Message' => "You have successfully logged in",
            'token' => $token,
        ]);
    }else{
        return response([
            'Message' => "Invalid email or password",
        ]);
    }
}
}
