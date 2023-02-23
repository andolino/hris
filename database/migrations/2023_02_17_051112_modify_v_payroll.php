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
        DB::statement("CREATE OR REPLACE VIEW v_payroll AS
                        SELECT 
                            e.*, 
                            es.basic_rate,
                            p.base_rate, 
                            p.days_worked, 
                            p.ot, 
                            p.sick_leave, 
                            p.vacation_leave, 
                            p.allowance, 
                            p.regular_holiday, 
                            p.special_holiday, 
                            p.subsidy, 
                            p.late, 
                            p.undertime, 
                            p.tot_deductions
                        FROM employees e 
                        left join payroll p on p.employee_id = e.id
                        left join employee_salary es on es.employees_id = e.id");
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
