<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;

class UserController extends Controller
{

    public function index()
    {
        return view('customers.index', ['users' =>User::where('role', 'ROLE_ADMIN')->get(['id','name', 'email', 'created_at'])]);

    }

    public function create()
    {
        return view('admins.create');
    }


    public function store(StoreAdminRequest $request)
    {
        User::updateOrCreate(['id' => $request->user_id , 'password' => Hash::make($request->password),'role' => 'ROLE_ADMIN'], $request->except('user_id','password'));

        return  redirect()->back()->with('success', 'Administrator Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admins.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admins.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully!!');
    }
}
