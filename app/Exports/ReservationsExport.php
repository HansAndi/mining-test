<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Reservation::all();
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user->name,
            $reservation->location->name,
            $reservation->vehicle->name,
            $reservation->driver->name,
            $reservation->leader->name,
            $reservation->status->name,
            $reservation->start_date,
            $reservation->end_date,
            $reservation->approval,
            $reservation->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Location',
            'Vehicle',
            'Driver',
            'Leader',
            'Status',
            'Start Date',
            'End Date',
            'Approval',
            'Created At',
        ];
    }
}
