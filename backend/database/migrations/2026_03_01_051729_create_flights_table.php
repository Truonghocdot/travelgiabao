<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline_code', 10);       // VU, 9G, VN, VJ, QH
            $table->string('airline_name');             // Vietravel Airlines
            $table->string('flight_number', 20);        // VU702
            $table->string('origin_code', 10);          // SGN
            $table->string('origin_name');              // Hồ Chí Minh
            $table->string('destination_code', 10);     // HAN
            $table->string('destination_name');         // Hà Nội
            $table->string('departure_time', 5);        // 02:20
            $table->string('arrival_time', 5);          // 04:35
            $table->integer('duration_minutes');         // 134
            $table->string('aircraft_type', 10);        // 321, 32Q
            $table->integer('price');                    // 793240
            $table->integer('day_of_week')->default(0); // 0=everyday, 1=Mon..7=Sun
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
