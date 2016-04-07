<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\Role;
class UserController extends Controller
{
    public function index()
    {
        return $this->listview(User::all());
    }
    private function listview($users) 
    {
        return view('admin.users', [
            'module' => 'users', 'users' => $users
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search 
        . '%')->orWhere('username', 'like', '%' . $search . '%')->get();
        return listview($users);
    }
    public function create()
    {
        return view('admin.user', ['roles' => Role::all(), 'module' => 'users']);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'username' => 'required|min:6|max:150|unique:users',
        'password' => 'required|min:6|confirmed'
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);
        return $this->formview($user);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        return $this->formview(User::findOrFail($id));
    }
    public function update(Request $request, $id)
    {
        $email = $request->input('email');
        $user = User::findOrFail($id);
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255' .  strcasecmp($email, $user->email) == 0?'':'|unique:users',
        'password' => 'required|min:6|confirmed'
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role');
        $user->save();
        return $this->formview($user);
    }
    private function formview($user) 
    {
        return view('admin.user', ['roles' => Role::all(), 'data' => 
        $user,  'module' => 'users']);
    }
    public function destroy($id)
    {
        User::destroy($id);
        return $this->listview(User::all());
    }
}
