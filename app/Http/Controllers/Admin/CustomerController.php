<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers', [
            'search' => '/admin/customers/search/', 'customers' => Customer::all(), 
            'link' => '/admin/customers/create'
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $customers = Customer::where('name', 'like', '%' . $search . '%')->orWhere('identification', 'like', 
        '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')->get();
        return view('admin.customers', [
            'search' => '/admin/customers/search/', 'customers' => $customers, 'link' => '/admin/customers/create'
        ]);
    }
    public function create()
    {
        return view('admin.customer', ['title' => 'Nuevo cliente']);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'identification' => 'required|digits_between:10,13|unique:customers',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
        ]);
        $customer = Customer::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'), 
            'identification' => $request->input('identification'),
            'reference' => $request->input('reference'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);
        return view('admin.customer', ['title' => 'Modificar cliente', 'customer' => 
        $customer, 'method' => 'PUT', 'action' => '/admin/customers/' . $customer->id, 
        'message' => 'Cliente creado con éxito.' ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        return view('admin.customer', ['title' => 'Modificar cliente', 
         'customer' => Customer::findOrFail($id), 'method' => 'PUT', 'action' => '/admin/customers/' . $id ]);
    }
    public function update(Request $request, $id)
    {
        $identification = $request->input('identification');
        $customer = Customer::findOrFail($id);
        $this->validate($request, [
        'identification' => 'required|digits_between:10,13' .  strcasecmp($identification, 
        $customer->identification) == 0?'':'|unique:customers',
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
        ]);
        $customer->identification = $identification;
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->latitude = $request->input('latitude');
        $customer->longitude = $request->input('longitude');
        $customer->reference = $request->input('reference');
        $customer->save();
        return view('admin.customer', ['title' => 'Modificar cliente', 
        'customer' => $customer, 'method' => 'PUT', 'action' => '/admin/customers/' . $id, 
        'message' => 'Cliente modificado con éxito.' ]);
    }
    public function destroy($id)
    {
        Customer::destroy($id);
        return view('admin.customers', [
            'search' => '/admin/customers/search/', 'customers' => Customer::all(), 
            'link' => '/admin/customers/create'
        ]);
    }
}
