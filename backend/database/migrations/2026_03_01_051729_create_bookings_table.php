<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 20)->unique();
            // Flight info
            $table->string('flight_number', 20);
            $table->string('airline_name');
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('departure_time', 5)->nullable();
            $table->string('arrival_time', 5)->nullable();
            $table->string('flight_date')->nullable();
            $table->integer('price')->default(0);
            // Customer info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->text('customer_note')->nullable();
            $table->integer('passengers')->default(1);
            // Status
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
