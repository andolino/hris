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
        Schema::create('dtr', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('day_type_id')->nullable();
            $table->foreign('day_type_id')->references('id')->on('day_type')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->date('payroll_date');
            $table->date('trans_date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->decimal('late_time', 12, 2)->nullable();
            $table->decimal('under_time', 12, 2)->nullable();
            $table->decimal('ot_time', 12, 2)->nullable();
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
        Schema::dropIfExists('dtr');
    }
};
