<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('locations.edit', $row->id);
                    $deleteUrl = route('locations.destroy', $row->id);

                    return view('components.action', [
                        'editUrl' => $editUrl,
                        'deleteUrl' => $deleteUrl
                    ])->render();
                })
                ->make(true);
        }

        $title = 'Delete Location!';
        $text = "Are you sure you want to location?";
        confirmDelete($title, $text);

        return view('pages.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to create location', 'error');
            return redirect()->route('locations.index');
        }

        return view('pages.locations.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        try {
            Location::create($request->validated());

            Alert::toast('Location created successfully', 'success');

            return redirect()->route('locations.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to create location', 'error');
            return redirect()->route('locations.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to edit location', 'error');
            return redirect()->route('locations.index');
        }

        return view('pages.locations.form', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        try {
            $location->update($request->validated());

            Alert::toast('Location updated successfully', 'success');

            return redirect()->route('locations.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to update location', 'error');
            return redirect()->route('locations.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to delete location', 'error');
            return redirect()->route('locations.index');
        }

        try {
            $location->delete();

            Alert::toast('Location deleted successfully', 'success');

            return redirect()->route('locations.index');
        } catch (\Exception $e) {
            Alert::toast('Failed to delete location', 'error');
            return redirect()->route('locations.index');
        }
    }
}
