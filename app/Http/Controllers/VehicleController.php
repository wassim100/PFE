<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Category;
use App\Models\Customer;

class VehicleController extends Controller
{

  public function index()
  {
      $userAuth = auth()->user();
      $role = $userAuth->role;
  
      if ($role == "ROLE_ADMIN") {
          $vehicles = Vehicle::with(['customer:id,name', 'user:id,name', 'category:id,name'])->get();
          return view('vehicles.index', ['vehicles' => $vehicles]);
      } else {
          $vehicles = Vehicle::with(['customer:id,name', 'user:id,name', 'category:id,name'])
              ->where('created_by', $userAuth->id)
              ->get();
          return view('vehicles.index', ['vehicles' => $vehicles]);
      }
  }
    public function create()
    {
        return view('vehicles.create', ['categories' => Category::get(['id','name']),
        'customers' => Customer::get(['id','name'])]);
    }

    public function store(StoreVehicleRequest $request)
    {
      try {
        $userAuth = auth()->user();
        $role = $userAuth->role;
  
        if ($role == "ROLE_ADMIN") {
        Vehicle::updateOrCreate(['id' => $request->vehicle_id], $request->except('vehicle_id', 'status') + ['status' => $request->status]);
        return redirect()->route('vehicles.index')->with('success',  $request->vehicle_id ? 'Vehicle Updated Successfully!!' : 'Vehicle Created Successfully!!');
        }else{
          Vehicle::updateOrCreate(['id' => $request->vehicle_id , 'created_by' => $userAuth->id , 'customer_id' =>  2 , 'packing_charge' => 0 , 'status' => 1 ], $request->except('vehicle_id', 'status','customer->id') + ['status' => $request->status]);
        return redirect()->route('vehicles.index')->with('success',  $request->vehicle_id ? 'Vehicle Updated Successfully!!' : 'Vehicle Created Successfully!!');
        }
      } catch (\Throwable $th) {
        return redirect()->route('vehicles.create')->with('error', 'Vehicle Cannot be Create please check the inputs!!');
      }
    }

    public function show(Vehicle $vehicle)
    {
        //
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'), ['categories' => Category::get(['id','name']),
        'customers' => Customer::get(['id','name'])]);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle Deleted Successfully!!');

    }
}
