<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Cẩm nang');  // Cẩm nang, Tin hàng không, Mẹo du lịch, Khuyến mãi, Sự kiện
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('author')->default('Gia Bảo');
            $table->integer('read_time')->default(5); // phút
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
