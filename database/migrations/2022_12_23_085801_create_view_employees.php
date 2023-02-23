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
        DB::statement("CREATE VIEW v_employees AS
                        SELECT 
                            emp.*, 
                            es.title as employee_status, 
                            d.title as department
                        FROM `employees` emp
                        left join employee_status es on es.id = emp.employee_status_id
                        left join department d on d.id = emp.department_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
