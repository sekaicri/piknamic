<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RequestLogin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
                'user'      => $user
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
                'success' => false,
                'message' => 'Los datos son incorrectos',
                'data'    => null
            ]);
        }
    
        $projects = DB::table('projects')->where('user_id', $user->id)->get();
    
        foreach ($projects as $project) {
            $information = json_decode($project->information, true);
    
            if (isset($information['name']) && $information['name'] === 'newproject') {
                DB::table('projects')->where('id', $project->id)->delete();
            }
        }
    
        return response()->json([
            'success'  => true,
            'message'  => 'Login exitoso',
            'user'     => $user,
            'projects' => $projects,
        ]);
    }

    public function loginWithIdAndEmail(Request $request)
    {
        $user = User::where('id', $request->input('id'))
                    ->where('email', $request->input('email'))
                    ->first();
    
        if (!$user) {
            return response()->json([
                'success'   => false,
                'message'   => 'Los datos son incorrectos',
                'data'      => null
            ]);
        }
    
        $creation = DB::select('SELECT * FROM projects WHERE user_id = ?', [$user->id]);
    
        return response()->json([
            'success'   => true,
            'message'   => 'Login exitoso',
            'user'      => $user,
            'projects'  => $creation,
        ]);
    }
    
}
