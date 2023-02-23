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
        DB::statement("CREATE OR REPLACE VIEW v_leave_request AS
                        SELECT 
                            e.lastname,
                            e.firstname,
                            e.middlename,
                            dt.title,
                            el.transaction_date,
                            el.date_from,
                            el.date_to,
                            el.no_of_days,
                            el.credit_used
                        from employee_leave_request el
                        LEFT JOIN day_type dt ON dt.id = el.day_type_id
                        LEFT JOIN employees e ON e.id = el.employee_id");
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
