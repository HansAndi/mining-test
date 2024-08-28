<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\Request;
use App\Models\VehicleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreVehicleServiceRequest;
use App\Http\Requests\UpdateVehicleServiceRequest;

class VehicleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VehicleService::with('vehicle')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('vehicle', function ($row) {
                    return $row->vehicle->name;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('vehicle-service.edit', $row->id);
                    $deleteUrl = route('vehicle-service.destroy', $row->id);

                    return view('components.action', [
                        'editUrl' => $editUrl,
                        'deleteUrl' => $deleteUrl
                    ])->render();
                })
                ->make(true);
        }

        return view('pages.services.index', [
            'vehicles' => DB::table('vehicles')->select('id', 'name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to create vehicle service', 'error');
            return redirect()->route('vehicle-service.index');
        }

        return view('pages.services.create', [
            'vehicles' => DB::table('vehicles')->select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleServiceRequest $request)
    {
        try {
            VehicleService::create($request->validated());

            Alert::toast('Vehicle service created successfully', 'success');

            return redirect()->route('vehicle-service.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to create vehicle service', 'error');

            return redirect()->route('vehicle-service.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleService $vehicleService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleService $vehicleService)
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to edit vehicle service', 'error');
            return redirect()->route('vehicle-service.index');
        }

        return view('pages.services.create', [
            'vehicleService' => $vehicleService,
            'vehicles' => DB::table('vehicles')->select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleServiceRequest $request, VehicleService $vehicleService)
    {
       try {
            $vehicleService->update($request->validated());

            Alert::toast('Vehicle service updated successfully', 'success');

            return redirect()->route('vehicle-service.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to update vehicle service', 'error');

            return redirect()->route('vehicle-service.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleService $vehicleService)
    {
       try {
            $vehicleService->delete();

            Alert::toast('Vehicle service deleted successfully', 'success');

            return redirect()->route('vehicle-service.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to delete vehicle service', 'error');

            return redirect()->route('vehicle-service.index');
        }
    }
}
