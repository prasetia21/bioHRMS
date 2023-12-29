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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->double('latitude1')->nullable();
            $table->double('latitude2')->nullable();
            $table->double('longitude1')->nullable();
            $table->double('longitude2')->nullable();
            $table->double('distance')->nullable();
            $table->string('city_name')->nullable();
            $table->string('sharelok')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
