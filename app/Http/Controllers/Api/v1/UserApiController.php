<?php

namespace App\Http\Controllers\Api\v1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\ApiResponse;
class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        $response = (count($users) == 0)? new ApiResponse(true, 'No se encontró resultados.', null):new ApiResponse(
            false, '¡Consulta exitosa!', $users
        );
        return response()->json($response);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (isset($user))
            return response()->json(new ApiResponse(true, 'Correo electrónico ya registrado.', null));
        else 
        {
            $username = $request->input('username');
            $user = User::where('username', $username);
            if (isset($user))
                return response()->json(new ApiResponse(true, 'Nombre de usuario ya registrado.', null));
            else 
            {
                $user = User::create(['role_id' => $request->input('role'), 'name' => $request->input('name'),
                'email' => $email, 'username' => $username, 'password' => bcrypt($request->input('password'))]);
                return response()->json(new ApiResponse(false, 'Usuario creado con éxito.', $user));
            }
        }
    }
    public function circles($id) 
    {
        
    }
    public function show($id)
    {
        $user = User::find($id);
        $response = (isset($user))? new ApiResponse(false, 'Usuario encontrado.', $user):new ApiResponse(true, 
        'Usuario no existente.', null);
        return response()->json($response);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (isset($user)) 
        {
            $email = $request->input('email');
            $existent = User::where('email', $email)->first();
            if (isset($existent))
            {
                if ($existent->id != $user->id)
                    return response()->json(new ApiResponse(true, 'Correo electrónico existente.', null));
            }
            $user->name = $request->input('name');
            $user->email = $email;
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return response()->json(new ApiResponse(false, 'Usuario actualizado con éxito.', $user));
        }
        else 
            return response()->json(new ApiResponse(true, 'Usuario no existente, imposible actualizar.', null));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (isset($user))
        {
            $user->delete();
            return response()->json(new ApiResponse(false, 'Usuario eliminado con éxito.', null));
        }
        return response()->json(new ApiResponse(true, 'Usuario no existente, no se puede eliminar', null));
    }
}
