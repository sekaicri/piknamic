<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RequestLogin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {

        $filename="";
        if($request->hasFile('imagen')){
            $filename=$request->file('imagen')->store('posts','public');
        }else{
            $filename=Null;
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'imagen' =>  $filename
        ]);
        return response()->json([
            'success'   => true,
            'message'   => 'Registro exitoso',
            'data'      => $user
        ]);

        
    }
    public function login(RequestLogin $request)
    {

     $user = User::where('email',$request['email'])->first();
     if(!$user||!Hash::check($request['password'], $user->password)){
        return response()->json([
            'success'   => true,
            'message'   => 'Los datos son incorrectos',
            'data'      => null
        ]);
     }
        return response()->json([
            'success'   => true,
            'message'   => 'Login exitoso',
            'user'      => $user,
        ]);
    }


}

