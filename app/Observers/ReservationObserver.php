<?php

namespace App\Observers;

use App\Enums\Approval;
use App\Enums\ReservationStatus;
use App\Enums\VehicleStatus;
use App\Models\Location;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     */
    public function created(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "updated" event.
     */
    public function updated(Reservation $reservation): void
    {
        // dd($reservation->is_returned);

        if ($reservation->is_returned) {
            // dd('returned');
            $reservation->vehicle->update([
                'status_id' => 1,
            ]);
        }
        // DB::beginTransaction();

        // try {

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     throw $e;
        // }
    }

    /**
     * Handle the Reservation "deleted" event.
     */
    public function deleted(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "restored" event.
     */
    public function restored(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "force deleted" event.
     */
    public function forceDeleted(Reservation $reservation): void
    {
        //
    }
}
