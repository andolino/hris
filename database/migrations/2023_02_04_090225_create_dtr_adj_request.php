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
        Schema::create('dtr_adj_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                    ->references('id')->on('employees')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->dateTime('trans_date');
            $table->string('time_type')->comment('IN or OUT');
            $table->unsignedBigInteger('branch_id')->comment('where BRANCH IN or BRANCH OUT')->nullable();
            $table->foreign('branch_id')
                    ->references('id')->on('branches')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->boolean('is_deleted')->default(false);
            $table->tinyInteger('status')->default(0)->comment("0 = pending, 1 = approved, 2 = rejected");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('dtr_adj_request');
    }
};
