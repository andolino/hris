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
        Schema::table('other_deduction', function (Blueprint $table) {
            $table->decimal('canteen', 12, 2)->default(0)->change();
            $table->decimal('union_medical', 12, 2)->default(0)->change();
            $table->decimal('union_assistance', 12, 2)->default(0)->change();
            $table->decimal('pa_adj', 12, 2)->default(0)->change();
            $table->decimal('other_deductions', 12, 2)->default(0)->change();
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
