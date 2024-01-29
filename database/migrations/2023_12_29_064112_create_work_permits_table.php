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
        Schema::create('work_permits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('present_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('approval')->default(false);
            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade');
            $table->foreign('present_id')
                ->references('id')->on('presents')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_permits');
    }
};
