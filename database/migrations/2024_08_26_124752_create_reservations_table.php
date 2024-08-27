<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->nullable();
            $table->foreignId('location_id')->constrained('locations');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('driver_id')->constrained('users')->nullable();
            $table->foreignId('pool_id')->constrained('users')->nullable();
            $table->foreignId('leader_id')->constrained('users')->nullable();
            $table->foreignId('status_id')->constrained('reservation_statuses')->default(1);
            $table->boolean('pool_approved')->default(false);
            $table->boolean('leader_approved')->default(false);
            $table->boolean('is_returned')->default(false);
            $table->integer('fuel_usage')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
