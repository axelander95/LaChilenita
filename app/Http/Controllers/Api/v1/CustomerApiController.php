<?php
namespace App\Http\Controllers\Api\v1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Customer;
use App\Models\ApiResponse;
class CustomerApiController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $response = (count($customers) == 0)? new ApiResponse(true, 'No se encontró resultados.', null):new ApiResponse(
            false, '¡Consulta exitosa!', $customers
        );
        return response()->json($response);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $identification = $request->input('identification');
        $customer = Customer::where('identification', $identification)->first();
        if (isset($customer)) 
            return response()->json(new ApiResponse(true, 'El número de identificación ya se encuentra registrado.', null));
        else 
        {
            $customer = Customer::create(['identification' => $identification, 
            'name' => $request->input('name')]);
            return response()->json(new ApiResponse(false, 'Cliente creado con éxito.', $customer));
        }
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        $response = (isset($customer))? new ApiResponse(false, 'Cliente encontrado.', $customer):new ApiResponse(true, 
        'Cliente no existente.', null);
        return response()->json($response);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (isset($customer)) 
        {
            $identification = $request->input('identification');
            $existent = Customer::where('identification', $identification)->first();
            if (isset($existent))
            {
                if ($existent->id != $id)
                    return response()->json(new ApiResponse(true, 'El número de identificación ya pertenece a otro cliente.', null));
            }
            $customer->identification = $identification;
            $customer->name = $request->input('name');
            $customer->address = $request->input('address');
            $customer->save();
            return response()->json(new ApiResponse(false, 'Cliente actualizado con éxito.', $customer));
        }
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (isset($customer))
        {
            $customer->delete();
            return response()->json(new ApiResponse(false, 'Cliente eliminado con éxito.', null));
        }
        return response()->json(new ApiResponse(true, 'Cliente no existente, no se puede eliminar', null));
    }
}
