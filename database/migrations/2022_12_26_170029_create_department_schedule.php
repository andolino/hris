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
        Schema::create('department_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('department')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('day_type_id')->nullable();
            $table->foreign('day_type_id')->references('id')->on('day_type')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
            $table->unsignedBigInteger('shifting_id')->nullable();
            $table->foreign('shifting_id')->references('id')->on('shifting')
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
        Schema::dropIfExists('department_schedule');
    }
};
