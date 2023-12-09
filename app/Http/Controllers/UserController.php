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
    
        $projectsArray = $projects->toArray();
        $filteredProjects = array_filter($projectsArray, function ($project) {
            return strpos($project->information, 'newproject') === false;
        });
    
        $deletedProjects = array_diff(array_column($projectsArray, 'id'), array_column($filteredProjects, 'id'));
        if (!empty($deletedProjects)) {
            DB::table('projects')->whereIn('id', $deletedProjects)->delete();
        }
    
        return response()->json([
            'success'  => true,
            'message'  => 'Login exitoso',
            'user'     => $user,
            'projects' => array_values($filteredProjects),
        ]);
    }

    public function loginWithIdAndEmail(Request $request)
    {
        $user = User::where('id', $request->input('id'))
                    ->where('email', $request->input('email'))
                    ->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Los datos son incorrectos',
                'data'    => null
            ]);
        }
    
        $projects = DB::table('projects')->where('user_id', $user->id)->get();
    
        $filteredProjects = $projects->reject(function ($project) {
            return strpos($project->information, 'newproject') !== false;
        });
    
        $deletedProjects = $projects->pluck('id')->diff($filteredProjects->pluck('id')->toArray());
        if ($deletedProjects->isNotEmpty()) {
            DB::table('projects')->whereIn('id', $deletedProjects)->delete();
        }
    
        return response()->json([
            'success'  => true,
            'message'  => 'Login exitoso',
            'user'     => $user,
            'projects' => $filteredProjects->values(),
        ]);
    }
    
}
