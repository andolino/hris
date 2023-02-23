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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                    ->references('id')->on('employees')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->unsignedBigInteger('loan_type_id')->nullable();
            $table->foreign('loan_type_id')
                    ->references('id')->on('loan_types')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->unsignedBigInteger('loan_ded_type_id')->nullable();
            $table->foreign('loan_ded_type_id')
                    ->references('id')->on('loan_ded_type')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->decimal('loan_amount', 12, 2)->nullable();
            $table->decimal('amortization', 12, 2)->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_end')->nullable();
            $table->string('loan_ref')->nullable();
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
        Schema::dropIfExists('loans');
    }
};
