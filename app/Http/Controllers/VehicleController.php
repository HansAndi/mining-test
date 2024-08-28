<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Vehicle;
use App\Enums\VehicleType;
use App\Enums\VehicleOwner;
use App\Enums\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vehicle::with('status')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row) {
                    return $row->status->name;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('vehicles.edit', $row->id);
                    $deleteUrl = route('vehicles.destroy', $row->id);

                    return view('components.action', [
                        'editUrl' => $editUrl,
                        'deleteUrl' => $deleteUrl
                    ])->render();
                })
                ->make(true);
        }

        return view('pages.vehicles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to create vehicle', 'error');
            return redirect()->route('vehicles.index');
        }

        $types = collect(VehicleType::getOptions())->map(function ($item) {
            return (object) $item;
        });
        // dd($types);

        $owners = collect(VehicleOwner::getOptions())->map(function ($item) {
            return (object) $item;
        });

        $statuses = collect(VehicleStatus::getOptions())->map(function ($item) {
            return (object) $item;
        });
        // dd($statuses);

        return view('pages.vehicles.form', compact('types', 'owners', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        // dd($request->validated());
        try {
            Vehicle::create($request->validated());

            Alert::toast('Vehicle created successfully', 'success');
            return redirect()->route('vehicles.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to create vehicle', 'error');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to create vehicle', 'error');
            return redirect()->route('vehicles.index');
        }

        $types = collect(VehicleType::getOptions())->map(function ($item) {
            return (object) $item;
        });

        $owners = collect(VehicleOwner::getOptions())->map(function ($item) {
            return (object) $item;
        });

        $statuses = collect(VehicleStatus::getOptions())->map(function ($item) {
            return (object) $item;
        });

        return view('pages.vehicles.form', compact('vehicle', 'types', 'owners', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $vehicle->update($request->validated());

            Alert::toast('Vehicle updated successfully', 'success');
            return redirect()->route('vehicles.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to update vehicle', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();

            Alert::toast('Vehicle deleted successfully', 'success');
            return redirect()->route('vehicles.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to delete vehicle', 'error');
            return redirect()->back();
        }
    }
}
