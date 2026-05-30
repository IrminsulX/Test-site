<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('admin_homepage_images', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('admin_homepage_images');
    }
};
