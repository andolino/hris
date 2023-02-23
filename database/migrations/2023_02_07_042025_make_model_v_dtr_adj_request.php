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
        DB::statement("CREATE OR REPLACE VIEW v_dtr_adj_request AS
                        SELECT 
                            dar.*,
                            e.lastname,
                            e.firstname,
                            e.middlename,
                            b.branch_name,
                            u.name
                        FROM dtr_adj_request dar
                        left join employees e on e.id = dar.employee_id 
                        left join branches b on b.id = dar.branch_id 
                        left join users u on u.id = dar.user_id");

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
