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
        DB::statement("CREATE OR REPLACE VIEW v_loans AS
                        SELECT 
                            l.*, 
                            concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as fullname,
                            lt.title as loan_types_name,
                            ldt.title as loan_deduction_type 
                        FROM loans l
                        LEFT JOIN employees e on e.id = l.employee_id
                        LEFT JOIN loan_types lt on lt.id = l.loan_type_id 
                        LEFT JOIN loan_ded_type ldt on ldt.id = l.loan_ded_type_id");
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
