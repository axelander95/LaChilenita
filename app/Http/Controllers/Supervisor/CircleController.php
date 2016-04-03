<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Circle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserVisit;
class CircleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('supervisor.panel', ['circles' => $user->circles]);
    }
    public function create($id)
    {
        $user = Auth::user();
        $circle = Circle::where('id', $id)->where('user_id', $user->id)->first();
        return view('supervisor.visit', ['title' => 'Nueva visita', 
        'customers' => Customer::all(), 'users' => $circle->users, 'id' => $id ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'circle' => 'required',
        'user' => 'required',
        'customer' => 'required',
        'date' => 'required|date',
        'time' => 'required'
        ]);
        $visit = new UserVisit;
        $visit->circle_id = $request->input('circle');
        $visit->user_id = $request->input('user');
        $visit->customer_id = $request->input('customer');
        $visit->visit_status_id = 1;
        $visit->programmed_date = $request->input('date');
        $visit->programmed_time = $request->input('time');
        $visit->detail = $request->input('detail');
        $visit->save();
        return view('supervisor.visit', ['title' => 'Modificar visita', 
        'customers' => Customer::all(), 'users' => $visit->circle->users, 'visit' => $visit, 
        'id' => $visit->circle_id, 'method' => 'put', 'action' => '/supervisor/visits/' . $visit->id ]);
    }
    public function show($id)
    {
        $circle = Circle::findOrFail($id);
        $visits = $circle->visits()->whereIn('visit_status_id', [ 1, 2 ] )->get();
        return view('supervisor.visits', ['visits' => $visits, 
        'name' => $circle->name, 'id' => $circle->id]);
    }
    public function edit($id)
    {
        $visit = UserVisit::findOrFail($id);
        return view('supervisor.visit', ['title' => 'Modificar visita', 
        'customers' => Customer::all(), 'users' => $visit->circle->users, 'visit' => $visit, 
        'id' => $visit->circle_id, 'method' => 'put', 'action' => '/supervisor/visits/' . $visit->id ]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'user' => 'required',
        'customer' => 'required',
        'date' => 'required|date',
        'time' => 'required'
        ]);
        $visit = UserVisit::findOrFail($id);
        $visit->user_id = $request->input('user');
        $visit->customer_id = $request->input('customer');
        $visit->visit_status_id = 1;
        $visit->programmed_date = $request->input('date');
        $visit->programmed_time = $request->input('time');
        $visit->detail = $request->input('detail');
        $visit->save();
        return view('supervisor.visit', ['title' => 'Modificar visita', 
        'customers' => Customer::all(), 'users' => $visit->circle->users, 'visit' => $visit, 
        'id' => $visit->circle_id, 'method' => 'put', 'action' => '/supervisor/visits/' . $visit->id ]);
    }
    public function destroy($id)
    {
        $visit = UserVisit::findOrFail($id);
        $circle = Circle::findOrFail($visit->circle_id);
        $visit->delete();
        $visits = $circle->visits()->whereIn('visit_status_id', [ 1, 2 ] )->get();
        return view('supervisor.visits', ['visits' => $visits, 
        'name' => $circle->name, 'id' => $circle->id]);
    }
}
