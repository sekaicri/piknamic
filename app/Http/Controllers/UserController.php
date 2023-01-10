<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RequestLogin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        try {
            // inicio de transaccion
            DB::beginTransaction();
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            // confirmar transaccion
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Registro exitoso',
                'data'      => $user
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error En La Generación De La Solicitud'
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
    public function login(RequestLogin $request)
    {

        $user = User::where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json([
                'success'   => true,
                'message'   => 'Los datos son incorrectos',
                'data'      => null
            ]);
        }
        $creation = DB::SELECT('(SELECT * FROM projects al where user_id = ' .$user->id. ')');

        return response()->json([
            'success'   => true,
            'message'   => 'Login exitoso',
            'user'      => $user,
            'projects'  => $creation,


        ]);
    }
}
