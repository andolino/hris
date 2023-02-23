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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->foreign('loan_id')
                    ->references('id')->on('loans')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->date('payroll_date')->nullable();
            $table->decimal('payment_amount', 12, 2)->nullable();
            $table->decimal('balance', 12, 2)->nullable();
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
        Schema::dropIfExists('loan_details');
    }
};
