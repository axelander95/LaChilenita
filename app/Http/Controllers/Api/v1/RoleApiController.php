<?php

namespace App\Http\Controllers\Api\v1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\ApiResponse;
class RoleApiController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $response = (count($roles) == 0)? new ApiResponse(true, 'No se encontró resultados', null):new ApiResponse(
            false, '¡Consulta exitosa!', $roles);
        return response()->json($response);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $role = Role::find($id);
        $response = (isset($role))? new ApiResponse(false, 'Rol encontrado.', $role):new ApiResponse(true, 
        'No se encontró el rol solicitado.', null);
        return response()->json($response);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
