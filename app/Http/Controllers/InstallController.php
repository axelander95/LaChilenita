<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Configuration;
use App\Models\User;
class InstallController extends Controller
{
    public function index()
    {
        $configuration = Configuration::find(1);
        if ($configuration->installed == 0) 
        {
            return view('install');
        }
        else 
            return view('home');
    }
    public function create()
    {
        //
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
            'role_id' => 1,
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);
        $configuration = Configuration::find(1);
        $configuration->installed = 1;
        $configuration->user_id = $user->id;
        $configuration->save();
        return view('auth.login')->with('name', $user->name);
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
