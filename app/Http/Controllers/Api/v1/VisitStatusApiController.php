<?php 
namespace App\Http\Controllers\Api\v1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\VisitStatus;
use App\Models\ApiResponse;
class VisitStatusApiController extends Controller
{
    public function index()
    {
        $visit_statuses = VisitStatus::all();
        $response = (count($visit_statuses) == 0)? new ApiResponse(true, 'No se encontró resultados', null):new ApiResponse(
            false, '¡Consulta exitosa!', $visit_statuses);
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
        $visit_status = VisitStatus::find($id);
        $response = (isset($visit_status))? new ApiResponse(false, 'Estado de visita encontrado.', $visit_status):new ApiResponse(true, 
        'No se encontró el estado de visita solicitado.', null);
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
