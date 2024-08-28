<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $konsumsi = DB::table('reservations')
            ->select('start_date', DB::raw('sum(fuel_usage) as total_fuel_usage'))
            ->where('fuel_usage', '>', 0)
            ->groupBy('start_date')
            ->get();

        $pemakaian = DB::table('reservations')
            ->select('start_date', DB::raw('count(*) as total_reservation'))
            ->groupBy('start_date')
            ->get();

        $user = User::count();
        $vehicle = Vehicle::count();
        $location = Location::count();
        $reservation = Reservation::count();

        return view('dashboard', compact('konsumsi', 'pemakaian', 'user', 'vehicle', 'location', 'reservation'));
    }
}
