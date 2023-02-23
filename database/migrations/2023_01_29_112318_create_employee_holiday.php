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
        Schema::create('employee_holiday', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_type_id')->nullable();
            $table->foreign('day_type_id')
                    ->references('id')->on('day_type')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->string('day');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('employee_holiday');
    }
};
