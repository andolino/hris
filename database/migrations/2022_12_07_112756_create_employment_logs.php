<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->foreign('employees_id')->references('id')->on('employees')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('employment_status_id')->nullable();
            $table->foreign('employment_status_id')->references('id')->on('employment_status')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('employee_status_id')->nullable();
            $table->foreign('employee_status_id')->references('id')->on('employee_status')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_logs');
    }
};
