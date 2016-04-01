<?php

namespace App\Http\Controllers\Api\v1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Circle;
use App\Models\User;
use App\Models\ApiResponse;
class CircleApiController extends Controller
{
    public function index()
    {
        $circles = Circle::all();
        $response = (count($circles) == 0)? new ApiResponse(true, 'No se encontró resultados.', null):new ApiResponse(
            false, '¡Consulta exitosa!', $circles
        );
        return response()->json($response);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $user_id = $request->input('user');
        $user = User::find($user_id);
        if (isset($user)) 
        {
            if ($user->role_id == 2) 
            {
                $name = $request->input('name');
                $circle = Circle::where('name', $name);
                if (isset($circle))
                    return response()->json(new ApiResponse(true, 'Ya existe un círculo con este nombre.', null));
                else 
                {
                    $circle = Circle::create(['user_id' => $user_id , 'name' => $name, 
                    'description' => $request->input('description')]);
                    return response()->json(new ApiResponse(false, 'Círculo creado con éxito.', $circle));
                }
            }
            else 
                return response()->json(new ApiResponse(true, 'El usuario no es un supervisor.', null));
        }
        else 
            return response()->json(new ApiResponse(true, 'Usuario no existente.', null));
    }
    public function show($id)
    {
        $circle = Circle::find($id);
        $response = (isset($circle))? new ApiResponse(false, 'Círculo encontrado.', $circle):new ApiResponse(true, 
        'Círculo no existente.', null);
        return response()->json($response);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $circle = Circle::find($id);
        if (isset($circle)) 
        {
            $user_id = $request->input('user');
            $user = User::find($user_id);
            if (isset($user)) 
            {
                if ($user->role_id == 2) 
                {
                    $name = $request->input('name');
                $existent = User::where('name', $name)->first();
                if (isset($existent))
                {
                    if ($existent->id != $circle->id)
                        return response()->json(new ApiResponse(true, 'El nombre del círculo ya se encuentra registrado.', null));
                }
                $circle->name = $name;
                $circle->description = $request->input('description');
                $circle->user_id = $user_id;
                $circle->save();
                return response()->json(new ApiResponse(false, 'Usuario actualizado con éxito.', $user));
                }
                else 
                    return response()->json(new ApiResponse(true, 'El usuario no es un supervisor.', null));
            }
            else 
                return response()->json(new ApiResponse(true, 'Usuario no existente.', null));
        }
        else 
            return response()->json(new ApiResponse(true, 'Círculo no existente, imposible actualizar.', null));
    }
    public function destroy($id)
    {
        $circle = Circle::find($id);
        if (isset($circle))
        {
            $circle->delete();
            return response()->json(new ApiResponse(false, 'Círculo eliminado con éxito.', null));
        }
        return response()->json(new ApiResponse(true, 'Círculo no existente, no se puede eliminar.', null));
    }
}
