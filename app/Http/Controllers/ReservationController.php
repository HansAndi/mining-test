<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Approval;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Enums\VehicleStatus;
use Illuminate\Http\Request;
use App\Enums\ReservationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Reservation::with('user', 'location', 'status')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                // ->addColumn('vehicle', function ($row) {
                //     return $row->vehicle->name;
                // })
                ->addColumn('location', function ($row) {
                    return $row->location->name;
                })
                // ->addColumn('driver', function ($row) {
                //     return $row->driver->name;
                // })
                // ->addColumn('leader', function ($row) {
                //     return $row->leader->name;
                // })
                ->addColumn('status', function ($row) {
                    return $row->status->name;
                    $badgeClass = '';

                    switch ($status) {
                        case 'pending':
                            $badgeClass = 'warning';
                            break;
                        case 'rejected':
                            $badgeClass = 'danger';
                            break;
                        case 'approved':
                            $badgeClass = 'success';
                            break;
                    }

                    // return '<span class="badge text-bg-' . $badgeClass . '">' . ucfirst($status) . '</span>';
                    return view('pages.reservations.status', [
                        'status' => $status,
                        'badgeClass' => $badgeClass
                    ])->render();
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('reservations.edit', $row->id);
                    $deleteUrl = route('reservations.destroy', $row->id);

                    return view('components.action', [
                        'editUrl' => $editUrl,
                        'deleteUrl' => $deleteUrl
                    ])->render();
                })
                ->make(true);
        }

        return view('pages.reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id !== Role::Admin->value) {
            Alert::toast('You are not allowed to create reservation', 'error');
            return redirect()->route('reservations.index');
        }

        $vehicles = DB::table('vehicles')->select('id', 'name')->where('status_id', VehicleStatus::Available)->get();
        $locations = DB::table('locations')->select('id', 'name')->get();
        $drivers = DB::table('users')->select('id', 'name')->where('role_id', Role::Driver)->get();
        $leaders = DB::table('users')->select('id', 'name')->where('role_id', Role::Leader)->get();
        $employees = DB::table('users')->select('id', 'name')->where('role_id', Role::Employee)->get();
        $approvals = collect(Approval::getOptions())->map(function ($item) {
            return (object) $item; // Convert arrays to objects
        });

        return view('pages.reservations.form', compact('vehicles', 'locations', 'drivers', 'leaders', 'employees', 'approvals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        Reservation::create(
            array_merge(
                $request->validated(),
                ['admin_id' => $request->user()->id],
                ['status_id' => ReservationStatus::Pending]
            )
        );

        // return redirect()->route('reservations.index')->with('error', 'You are not allowed to create reservation');
        Alert::toast('Reservation created successfully', 'success');
        return redirect()->route('reservations.index');
        // if (Auth::user()->role_id == Role::Admin) {
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        // dd($reservation->admin_approved == Approval::Approve->value && $reservation->leader_approved == Approval::Approve->value);

        if (Auth::user()->role_id !== Role::Admin->value && Auth::user()->id !== Role::Leader->value) {
            Alert::toast('You are not allowed to edit reservation', 'error');
            return redirect()->route('reservations.index');
        }

        $vehicles = DB::table('vehicles')->select('id', 'name')->where('status_id', VehicleStatus::Available)->get();
        $locations = DB::table('locations')->select('id', 'name')->get();
        $drivers = DB::table('users')->select('id', 'name')->where('role_id', Role::Driver)->get();
        $leaders = DB::table('users')->select('id', 'name')->where('role_id', Role::Leader)->get();
        $employees = DB::table('users')->select('id', 'name')->where('role_id', Role::Employee)->get();
        $approvals = collect(Approval::getOptions())->map(function ($item) {
            return (object) $item;
        });

        return view('pages.reservations.form', compact('reservation', 'vehicles', 'locations', 'drivers', 'leaders', 'employees', 'approvals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        // dd($request->validated());
        DB::beginTransaction();

        try {
            $reservation->update($request->validated());

            if ($reservation->admin_approved == Approval::Approve->value && $reservation->leader_approved == Approval::Approve->value) {
                $reservation->update([
                    'status_id' => ReservationStatus::Approved
                ]);

                $reservation->vehicle->update([
                    'status_id' => VehicleStatus::Unavailable,
                ]);
            } elseif ($reservation->admin_approved == Approval::Reject->value && $reservation->leader_uapproved == Approval::Reject->value) {
                $reservation->status_id = ReservationStatus::Rejected->value;
                $reservation->save();
            } else {
                $reservation->status_id = ReservationStatus::Pending->value;
                $reservation->save();
            }

            DB::commit();

            Alert::toast('Reservation updated successfully', 'success');
            return redirect()->route('reservations.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Failed to update reservation', 'error');
            return redirect()->route('reservations.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
