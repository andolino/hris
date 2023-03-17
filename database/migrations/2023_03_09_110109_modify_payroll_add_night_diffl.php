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
        Schema::table('payroll', function (Blueprint $table) {
            $table->decimal('cba', 12, 2)->default(0)->change();
            $table->decimal('canteen', 12, 2)->default(0)->change();
            $table->decimal('union_medical', 12, 2)->default(0)->change();
            $table->decimal('union_assistance', 12, 2)->default(0)->change();
            $table->decimal('pa_adj', 12, 2)->default(0)->change();
            $table->decimal('night_diffl', 12, 2)->default(0)->after('ot');
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
