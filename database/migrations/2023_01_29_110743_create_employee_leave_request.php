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
        Schema::create('employee_leave_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                    ->references('id')->on('employees')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->unsignedBigInteger('day_type_id')->nullable();
            $table->foreign('day_type_id')
                    ->references('id')->on('day_type')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->dateTime('transaction_date')->nullable();
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->decimal('no_of_days', 12, 2)->default(0);
            $table->decimal('credit_used', 12, 2)->default(0);
            // $table->decimal('no_of_days', 12, 2)->default(0);
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
        Schema::dropIfExists('employee_leave_request');
    }
};
