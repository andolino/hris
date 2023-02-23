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
        Schema::table('employee_leave_balance', function (Blueprint $table) {
            $table->string('year')->after('employee_id');
            $table->unsignedBigInteger('day_type_id')->after('year')->nullable();
            $table->foreign('day_type_id')->references('id')->on('day_type')
                                        ->cascadeOnUpdate()
                                        ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
