<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_homepage_images', function (Blueprint $table) {
            $table->string('type')->default('dashboard'); // Defaulting to 'dashboard' for existing images
        });
    }

    public function down()
    {
        Schema::table('admin_homepage_images', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

};
