<?php

namespace App\Models;

use App\Enums\VehicleOwner;
use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Casts\AsEnumArrayObject;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = [
    //     'name',
    //     'type',
    //     'ownership',
    //     'status_id',
    //     'last_used_at'
    // ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function status()
    {
        return $this->belongsTo(VehicleStatus::class);
    }

    public function services()
    {
        return $this->belongsToMany(VehicleService::class);
    }
}
