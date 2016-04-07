<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Models;
use Illuminate\Support\Facades\Auth;
use App\Models\Circle;
class CircleMapController extends Controller
{
    public function index($circle)
    {
        $user = Auth::user();
        $circleMap = Circle::where('id', $circle)->where('user_id', $user->id)->first();
        return view('supervisor.map', ['circle' => $circleMap]);
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
        //
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
