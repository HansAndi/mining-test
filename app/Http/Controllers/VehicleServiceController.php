<?php

namespace App\Http\Controllers;

use App\Models\VehicleService;
use App\Http\Requests\StoreVehicleServiceRequest;
use App\Http\Requests\UpdateVehicleServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        return view('pages.services.create', [
            'vehicles' => DB::table('vehicles')->select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleServiceRequest $request)
    {
        // dd($request->validated());

        VehicleService::create($request->validated());

        return redirect()->route('vehicle-service.index')
            ->with('success', 'Vehicle service created successfully.');
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
        // $service = VehicleService::findorFail($vehicleService->id);
        // dd($vehicleService);

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
        $vehicleService->update($request->validated());

        return redirect()->route('vehicle-service.index')
            ->with('success', 'Vehicle service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleService $vehicleService)
    {
        $vehicleService->delete();

        return redirect()->route('vehicle-service.index')
            ->with('success', 'Vehicle service deleted successfully.');
    }
}
