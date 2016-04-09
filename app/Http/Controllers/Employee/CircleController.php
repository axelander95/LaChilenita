<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVisit;
use App\Models\User;
class CircleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $circles = $user->user_circles;
        return view('employee.panel', ['circles' => $circles]);
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
        $user = Auth::user();
        $visits = $user->visits()->whereIn('visit_status_id', [1, 2])->get();
        return view('employee.map', ['visits' => $visits]);
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
