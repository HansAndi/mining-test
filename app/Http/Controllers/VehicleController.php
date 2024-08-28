<?php

namespace App\Http\Controllers;

use App\Enums\VehicleOwner;
use App\Enums\VehicleStatus;
use App\Enums\VehicleType;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        // $vehicles = Vehicle::with('status')->latest()->get();
        return DataTables::of(Vehicle::query())->make(true);

    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        Vehicle::create($request->validated());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
