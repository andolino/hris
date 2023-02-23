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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                    ->references('id')->on('employees')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->decimal('base_rate', 12, 2)->default(0);
            $table->decimal('days_worked', 12, 2)->default(0);
            $table->decimal('ot', 12, 2)->default(0);
            $table->decimal('sick_leave', 12, 2)->default(0);
            $table->decimal('vacation_leave', 12, 2)->default(0);
            $table->decimal('allowance', 12, 2)->default(0);
            $table->decimal('regular_holiday', 12, 2)->default(0);
            $table->decimal('special_holiday', 12, 2)->default(0);
            $table->decimal('subsidy', 12, 2)->default(0);
            $table->decimal('late', 12, 2)->default(0);
            $table->decimal('undertime', 12, 2)->default(0);
            $table->decimal('tot_deductions', 12, 2)->default(0);
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('payroll');
    }
};
