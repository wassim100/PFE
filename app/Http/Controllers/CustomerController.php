<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAdminRequest;
class CustomerController extends Controller
{

    public function index()
    {
        $userAuth = auth()->user();
        return view('customers.index', ['users' =>User::where('role', 'ROLE_USER')->get(['id','name', 'email', 'created_at'])],compact('userAuth'));
    }
    
    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreAdminRequest $request)
    {
        User::updateOrCreate(['id' => $request->user_id , 'password' => Hash::make($request->password),'role' => 'ROLE_USER'], $request->except('user_id','password'));
        Customer::updateOrCreate(['id' => $request->user_id ], $request->except('user_id',));
        return  redirect()->back()->with('success', 'Client Added Successfully!!');
    }


    public function edit(User $user)
    {
        return view('customers.edit', compact('user'));
    }


    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer Deleted Successfully!!');
    }
}
