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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_level_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('departement_id');
            $table->unsignedBigInteger('nip')->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('start_work_date')->nullable();
            $table->string('contact_date')->nullable();
            $table->enum('status',['Tetap','Kontrak', 'Part-Time'])->default('Kontrak');
            $table->rememberToken();
            $table->foreign('user_level_id')
                ->references('id')->on('user_levels')
                ->onDelete('cascade');
            $table->foreign('position_id')
                ->references('id')->on('positions')
                ->onDelete('cascade');
            $table->foreign('departement_id')
                ->references('id')->on('departements')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
