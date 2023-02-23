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
        Schema::table('dtr', function($table){
            $table->unsignedBigInteger('shifting_id')->nullable()->after('day_type_id');
            $table->foreign('shifting_id')->references('id')->on('shifting')
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
