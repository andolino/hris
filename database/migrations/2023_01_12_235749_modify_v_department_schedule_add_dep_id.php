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
        DB::statement("CREATE OR REPLACE VIEW v_department_schedule AS
                        SELECT 
                            ds.id,
                            ds.department_id,
                            d.title as department_name,
                            dt.title as day_type_name,
                            s.start_time,
                            s.end_time,
                            s.total_hrs,
                            s.hr_break,
                            s.ot_hour,
                            s.grace_period,
                            ds.day,
                            ds.is_deleted
                            from department_schedule ds
                            left join department d on d.id = ds.department_id 
                            left join shifting s on s.id = ds.shifting_id
                            left join day_type dt on dt.id = ds.day_type_id");
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
