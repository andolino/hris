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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('idcode')->nullable();
            $table->string('bio_id')->nullable();
            $table->unsignedBigInteger('punching_id')->nullable();
            $table->foreign('punching_id')->references('id')->on('punching')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->date('date_hired')->nullable();
            $table->string('year_hired')->nullable();
            $table->unsignedBigInteger('employee_status_id')->nullable();
            $table->foreign('employee_status_id')->references('id')->on('employee_status')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('position')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('department')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('payroll_schedule_id')->nullable();
            $table->foreign('payroll_schedule_id')->references('id')->on('payroll_schedule')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('employment_status_id')->nullable();
            $table->foreign('employment_status_id')->references('id')->on('employment_status')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('education')->nullable();
            $table->string('degree')->nullable();
            $table->string('gov_sss_no')->nullable();
            $table->string('gov_philhealth_no')->nullable();
            $table->string('gov_pagibig_no')->nullable();
            $table->string('gov_tin_no')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
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
        Schema::dropIfExists('employees');
    }
};
