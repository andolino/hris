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
        DB::statement("CREATE OR REPLACE VIEW v_dtr AS
                        SELECT 
                            dtr.*, 
                            employees.lastname, 
                            employees.firstname,
                            employees.middlename
                        FROM dtr
                        LEFT JOIN employees ON employees.id = dtr.employee_id");
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
