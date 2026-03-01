<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('airports', function (Blueprint $table) {
            $table->integer('min_price')->default(0)->after('base_price');
            $table->integer('max_price')->default(0)->after('min_price');
        });

        // Copy base_price to min_price and set max_price = base_price * 1.5
        \DB::table('airports')->get()->each(function ($airport) {
            \DB::table('airports')->where('id', $airport->id)->update([
                'min_price' => $airport->base_price,
                'max_price' => (int)($airport->base_price * 1.8),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('airports', function (Blueprint $table) {
            $table->dropColumn(['min_price', 'max_price']);
        });
    }
};
