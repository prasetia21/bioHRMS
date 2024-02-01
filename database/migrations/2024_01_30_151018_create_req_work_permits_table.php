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
        Schema::create('req_work_permits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('present_id');
            $table->date('req_date');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->string('photo_in');
            $table->string('photo_out')->nullable();
            $table->text('location_in')->nullable();
            $table->text('location_out')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('note')->nullable();
            $table->string('attachment')->nullable();
            $table->string('departement')->nullable();
            $table->boolean('approval_1')->default(false);
            $table->boolean('approval_2')->default(false);
            $table->text('reject_1')->nullable();
            $table->text('reject_2')->nullable();
            $table->string('status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade');
            $table->foreign('present_id')
                ->references('id')->on('presents')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('req_work_permits', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
        
    }
};
