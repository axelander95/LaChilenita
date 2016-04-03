<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Circle;
use App\Models\User;
use App\Models\CircleUser;
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
        'users' => User::where('role_id', 2)->get(), 
        'members' => User::where('role_id', 3)->get()]);
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
        $members = $request->input('members');
        $circle_users = array();
        foreach ($members as $member){
            $circle_user = CircleUser::create([
                'circle_id' => $circle->id, 'user_id' => $member
            ]);
            $circle_users[] = $circle_user;
        }
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        $circle, 'method' => 'PUT', 'action' => '/admin/circles/' . $circle->id, 
        'message' => 'Círculo creado con éxito.', 'circle_users' => $circle_users, 
        'members' => User::where('role_id', 3)->get()]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        Circle::findOrFail($id), 'method' => 'PUT', 'action' => '/admin/circles/' . $id, 
        'members' => User::where('role_id', 3)->get(), 'circle_users' => 
        CircleUser::where('circle_id', $id)->get() ]);
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
        CircleUser::where('circle_id', $circle->id)->delete();
        $members = $request->input('members');
        $circle_users = array();
        foreach ($members as $member){
            $circle_user = CircleUser::create([
                'circle_id' => $circle->id, 'user_id' => $member
            ]);
            $circle_users[] = $circle_user;
        }
        return view('admin.circle', ['title' => 'Modificar círculo', 
        'users' => User::where('role_id', 2)->get(), 'circle' => 
        $circle, 'method' => 'PUT', 'action' => '/admin/circles/' . $id, 
        'message' => 'Círculo modificado con éxito.', 
        'members' => User::where('role_id', 3)->get(), 
        'circle_users' => $circle_users]);
    }
    public function destroy($id)
    {
        Circle::destroy($id);
        return view('admin.circles', [
            'search' => '/admin/circles/search/', 'circles' => Circle::all(), 
            'link' => '/admin/circles/create'
        ]);
    }
}
