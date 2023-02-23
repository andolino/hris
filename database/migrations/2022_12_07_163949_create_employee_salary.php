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
        Schema::create('employee_salary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->foreign('employees_id')->references('id')->on('employees')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->decimal('basic_rate', 12, 2)->default(0);
            $table->decimal('daily_rate', 12, 2)->default(0);
            $table->decimal('hourly_rate', 12, 2)->default(0);
            $table->decimal('factor', 12, 2)->default(0);
            $table->decimal('ecola', 12, 2)->default(0);
            $table->decimal('subsidy', 12, 2)->default(0);
            $table->decimal('allowance', 12, 2)->default(0);
            $table->decimal('cba', 12, 2)->default(0);
            $table->decimal('overtime_rate', 12, 2)->default(0);
            $table->boolean('is_collect_sss')->default(false);
            $table->tinyInteger('every_collect_sss')->default(0)->comment('0 = Every Payday, 1 = First Period, 2 = Second Period');
            $table->decimal('default_collect_sss', 12, 2)->default(0);
            $table->boolean('is_collect_pagibig')->default(false);
            $table->tinyInteger('every_collect_pagibig')->default(0)->comment('0 = Every Payday, 1 = First Period, 2 = Second Period');
            $table->decimal('default_collect_pagibig', 12, 2)->default(0);
            $table->boolean('is_collect_phic')->default(false);
            $table->tinyInteger('every_collect_phic')->default(0)->comment('0 = Every Payday, 1 = First Period, 2 = Second Period');
            $table->decimal('default_collect_phic', 12, 2)->default(0);
            $table->boolean('is_collect_tax')->default(false);
            $table->tinyInteger('every_collect_tax')->default(0)->comment('0 = Every Payday, 1 = First Period, 2 = Second Period');
            $table->decimal('default_collect_tax', 12, 2)->default(0);
            $table->boolean('is_collect_union')->default(false);
            $table->tinyInteger('every_collect_union')->default(0)->comment('0 = Every Payday, 1 = First Period, 2 = Second Period');
            $table->decimal('default_collect_union', 12, 2)->default(0);
            $table->decimal('personal_savings', 12, 2)->default(0);
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
        Schema::dropIfExists('employee_salary');
    }
};
