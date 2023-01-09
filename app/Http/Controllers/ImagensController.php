<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\imagens;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class ImagensController extends Controller
{
    public function register(Request $request)
    {
        try {
            $filename = "";
            if ($request->hasFile('imagen')) {
                $uniqid = uniqid();
                $file = $request->file('imagen');
                //$filename = $uniqid . '.' . $file->getClientOriginalExtension();
                $filename = $uniqid . '.png';
                $file->storeAs('public/storage/', $filename);
                //$filename = $request->file('imagen')->store('posts','public');
            }
            // inicio de transaccion
            DB::beginTransaction();
            $user = imagens::create([
    
                'imagen' =>  $filename
            ]);

            // confirmar transaccion
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Registro exitoso',
                'data'      => $user,
                'direction' =>  $file
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
}
