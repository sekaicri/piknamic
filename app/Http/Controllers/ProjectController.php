<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\project;
use App\Models\imagens;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function registerImagen(Request $request)
    {
        try {
            $filename = "";
            if ($request->hasFile('imagen')) {
                $uniqid = uniqid();
                $file = $request->file('imagen');
                $filename = $uniqid . '.' . $file->getClientOriginalExtension();
                $file->storeAs($request->project_id, $filename, 'public');
                // $filename = $request->file('imagen')->store('posts','public');
            } else {
                $filename = Null;
            }
            $filename = 'http://www.piknamic.com/storage/' . $request->project_id . '/' . $filename;
            // inicio de transaccion
            DB::beginTransaction();
            $user = imagens::create([
                'project_id' => $request['project_id'],
                'imagen' =>  $filename
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

    public function deleteImagen(Request $request)
    {
        DB::table('imagens')->where('imagen', $request->imagen)->delete();
        unlink($request->imagen);
    }

    public function showimagens(Request $request)
    {
        $creation = DB::SELECT('(SELECT * FROM imagens al where project_id = ' . $request->project_id . ')');
        return response()->json([
            'data'      => $creation
        ]);
    }



    public function UpdateProject(Request $request)
    {
        $user = project::find($request->id);
        if ($user) {
            $user->preview = $request->preview;
            $user->update();
            return response()->json([
                'success'   => true,
                'message'   => 'Los datos se actualizaron',
                'data'      => null
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Los datos son incorrectos',
                'data'      => null
            ]);
        }
    }


    public function RegisterProject(Request $request)
    {
        try {
            $project = project::find($request->name);
            if ($project != null) {
                $project->preview = $request->preview;
                $project->name = $request->name;
                $project->information = $request->information;
                $project->update();
                return response()->json([
                    'success'   => true,
                    'message'   => 'Los datos se actualizaron',
                    'data'      => null
                ]);
            } else {
                // inicio de transaccion
                DB::beginTransaction();
                $user = project::create([
                    'name' => $request['name'],
                    'information' => $request['information'],
                    'user_id' => $request['user_id']

                ]);
                // confirmar transaccion
                DB::commit();
                return response()->json([
                    'success'   => true,
                    'message'   => 'Registro exitoso',
                    'data'      => $user
                ]);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error En La Generación De La Solicitud'
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
