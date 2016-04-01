<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Circle;
use App\Models\User;
class CircleController extends Controller
{
    public function index()
    {
        return view('admin.circles', [
            'search' => '/admin/circles/search/', 'circles' => Circle::all(), 
            'link' => '/admin/circles/create'
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $circles = Circle::where('name', 'like', '%' . $search . '%')->get();
        return view('admin.circles', [
            'search' => '/admin/circles/search/', 'circles' => $circles, 'link' => '/admin/circles/create'
        ]);
    }
    public function create()
    {
        return view('admin.circle', ['title' => 'Nuevo círculo', 
        'users' => User::where('role_id', 2)->get()]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|max:255|unique:circles',
        'user' => 'required'
        ]);
        $circle = Circle::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user')
        ]);
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        $circle, 'method' => 'PUT', 'action' => '/admin/circles/' . $circle->id, 
        'message' => 'Círculo creado con éxito.' ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        Circle::findOrFail($id), 'method' => 'PUT', 'action' => '/admin/circles/' . $id ]);
    }
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $circle = Circle::findOrFail($id);
        $this->validate($request, [
        'name' => 'required|max:255' .  strcasecmp($name, $circle->name) == 0?'':'|unique:circles',
        'user' => 'required'
        ]);
        $circle->name = $name;
        $circle->user_id = $request->input('user');
        $circle->save();
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        $circle, 'method' => 'PUT', 'action' => '/admin/circles/' . $id, 
        'message' => 'Círculo modificado con éxito.' ]);
    }
    public function destroy($id)
    {
        //
    }
}
