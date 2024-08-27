<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'service_date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
