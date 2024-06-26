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
        Schema::create('technician_reports', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('employee_id')->unsigned();
            $table->unSignedBigInteger('location_id')->unsigned();
            $table->date('waktu_kunjungan');
            $table->string('nama_customer');
            $table->string('jenis_customer');
            $table->string('jenis_kunjungan');
            $table->string('hasil_kunjungan')->nullable();
            $table->string('follow_up');
            $table->string('aktivitas_kantor')->nullable();
            $table->string('keterangan_aktivitas')->nullable();
            $table->string('keterangan_tujuan')->nullable();
            $table->string('durasi_aktivitas')->nullable();
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_reports');
    }
};
