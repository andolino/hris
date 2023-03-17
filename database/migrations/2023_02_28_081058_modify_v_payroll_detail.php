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
        DB::statement("CREATE OR REPLACE VIEW v_payroll_detail AS 
            SELECT 
                d.employee_id,
                1 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                null as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join department dep on dep.id = e.department_id
            union 
            select 
                d.employee_id,
                2 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Basic Rate' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                count(d.time_in) * es.daily_rate as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on e.id = es.employees_id 
            left join department dep on dep.id = e.department_id
            where d.time_in != '00:00:00'
            group by d.payroll_date, e.id
            union
            select 
                d.employee_id,
                3 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Days Worked' as description,
                count(d.time_in) as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join department dep on dep.id = e.department_id
            where d.time_in != '00:00:00'
            group by d.payroll_date, d.employee_id
            union 
            select 
                d.employee_id,
                4 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                dt.title as description,
                elr.no_of_days as no_of_day,
                elr.no_of_hours as hrs,
                -- 10pm <= 5am is night differential
                (case when HOUR(SUBTIME(elr.date_to, '22:00:00')) < 8 then HOUR(SUBTIME(elr.date_to, '22:00:00')) else 0 end) as nd_hrs,
                elb.balance - sum(elr.no_of_days) over (order by d.id) as leave_balance,
                -- overtime
                (case when dt.is_ot_under = 1 then 
                    ((es.hourly_rate * (elr.no_of_hours - (case when HOUR(SUBTIME(elr.date_to, '22:00:00')) < 8 then HOUR(SUBTIME(elr.date_to, '22:00:00')) else 0 end)))) 
                    + (((es.hourly_rate * 0.10) + es.hourly_rate) + (case when HOUR(SUBTIME(elr.date_to, '22:00:00')) < 8 then HOUR(SUBTIME(elr.date_to, '22:00:00')) else 0 end))
                else 
                    null
                end) as debit,
                -- undertime
                (case when dt.is_ot_under = 2 then 
                    es.hourly_rate * elr.no_of_hours
                else 
                    null
                end) as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join employee_leave_request elr on elr.employee_id = e.id 
                        and d.trans_date = elr.transaction_date
            left join employee_leave_balance elb on elb.employee_id = e.id 
                        and elb.day_type_id = elr.day_type_id 
            left join day_type dt on dt.id = elr.day_type_id
            where 
            -- and d.time_in != '0000-00-00' 
            elr.status = 1
            and dt.is_ot_under > 0
            union 
            select 
                d.employee_id,
                5 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                dt.title as description,
                sum(elr.no_of_days) as no_of_day,
                concat(elr.no_of_hours, ' - ') as hrs,
                null as nd_hrs,
                elb.balance - sum(elr.no_of_days) as leave_balance,
                null as debit,
                (case when elb.balance - sum(elr.no_of_days) <= 0 then
                    -- you must be specified the value of no of days to balance credit
                    (es.daily_rate  * elr.no_of_days)
                else 
                    null end) as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join employee_leave_request elr on elr.employee_id = e.id 
                        and d.trans_date = elr.transaction_date
            left join employee_leave_balance elb on elb.employee_id = e.id 
                        and elb.day_type_id = elr.day_type_id 
            left join day_type dt on dt.id = elr.day_type_id
            where d.time_in != '0000-00-00' 
            -- and e.payroll_schedule_id = 2
            and elr.status <> 0
            and dt.is_ot_under = 0
            group by dt.id
            union 
            select 
                d.employee_id,
                6 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Allowance' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                es.allowance * count(d.time_in) as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            where d.time_in != '00:00:00'
            group by d.employee_id
            union 
            select 
                d.employee_id,
                7 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                dt2.title as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                (es.daily_rate * dt2.rate) - es.daily_rate as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join employee_holiday veh on veh.`date` = d.trans_date
            left join day_type dt2 on dt2.id = veh.day_type_id 
            where veh.name <> ''
            union 
            select 
                d.employee_id,
                8 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Subsidy' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                es.subsidy * count(d.time_in) as debit,
                null as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join employment_status es2 on es2.id = e.employment_status_id 
            where d.time_in != '00:00:00' and es2.title = 'REGULAR'
            group by d.employee_id
            union 
            select 
                d.employee_id,
                9 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Late' as description,
                null as no_of_day,
                sum(d.late_time * 60) as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                FORMAT((es.hourly_rate / 60) * sum(d.late_time * 60), 2) as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            where d.time_in != '0000-00-00'
            group by d.employee_id
            union 
            select 
                d.employee_id,
                10 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Undertime' as description,
                null as no_of_day,
                sum(d.under_time * 60) as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                FORMAT((es.hourly_rate / 60) * sum(d.under_time * 60), 2) as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            where d.time_in != '0000-00-00'
            group by d.employee_id
            union 
            select 
                d.employee_id,
                11 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                lt.title as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                l.amortization as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join loans l on l.employee_id = d.employee_id
            left join loan_types lt on lt.id = l.loan_type_id
            where d.time_in != '0000-00-00'
            group by l.id
            union 
            select 
                d.employee_id,
                12 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Canteen' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                od.canteen as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join other_deduction od on od.employee_id = e.id
            where d.time_in != '0000-00-00'
            union 
            select 
                d.employee_id,
                13 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Union Medical' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                od.union_medical as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join other_deduction od on od.employee_id = e.id
            where d.time_in != '0000-00-00'
            union 
            select 
                d.employee_id,
                14 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'Union Assistance' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                od.union_assistance as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join other_deduction od on od.employee_id = e.id
            where d.time_in != '0000-00-00'
            union 
            select 
                d.employee_id,
                14 as num,
                e.payroll_schedule_id,
                d.payroll_date,
                e.idcode,
                e.lastname,
                e.firstname,
                e.middlename,
                dep.title as department_name,
                'PA-Adj' as description,
                null as no_of_day,
                null as hrs,
                null as nd_hrs,
                null as leave_balance,
                null as debit,
                od.pa_adj as credit
            from dtr d
            left join employees e on e.id = d.employee_id
            left join employee_salary es on es.employees_id = d.employee_id 
            left join department dep on dep.id = e.department_id
            left join other_deduction od on od.employee_id = e.id
            where d.time_in != '0000-00-00'
            ");
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
