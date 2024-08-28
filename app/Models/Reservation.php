<?php

namespace App\Models;

use App\Enums\Approval;
use App\Observers\ReservationObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

// #[ObservedBy(ReservationObserver::class)]
class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_returned' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(ReservationStatus::class);
    }
}
