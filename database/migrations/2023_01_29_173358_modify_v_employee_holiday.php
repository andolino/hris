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
        DB::statement("CREATE OR REPLACE VIEW v_employee_holiday AS
                        SELECT 
                            eh.id,
                            eh.name, 
                            eh.day, 
                            eh.date, 
                            eh.created_at, 
                            eh.is_deleted, 
                            dt.title 
                            FROM employee_holiday eh
                            LEFT JOIN day_type dt ON dt.id = eh.day_type_id");
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
