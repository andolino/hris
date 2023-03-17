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
        Schema::table('day_type', function (Blueprint $table) {
            $table->boolean('is_ot_under')->tinyInteger('is_ot_under')->default(0)->comment('1 = OT, 2 = UNDERTIME, 3 = OT ALLOWANCE')->change();
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
