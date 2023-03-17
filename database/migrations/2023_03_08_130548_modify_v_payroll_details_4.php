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
                        select
                            d.employee_id as employee_id,
                            1 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        left join employee_salary es on e.id = es.employees_id
                        left join department dep on dep.id = e.department_id
                        union
                        select
                            d.employee_id as employee_id,
                            2 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            'Basic Rate' as description,
                            null as no_of_day,
                            null as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            case
                                when pr.basic_rate is null then es.basic_rate / 2
                                else pr.basic_rate
                            end as debit,
                            null as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on e.id = es.employees_id
                        left join department dep on dep.id = e.department_id
                        left join piece_rate pr on pr.employee_id = e.id and d.payroll_date = pr.payroll_date
                        where
                            d.time_in <> '00:00:00'
                        group by
                            d.payroll_date,
                            e.id
                        union
                        select
                            d.employee_id as employee_id,
                            3 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join piece_rate pr on pr.employee_id = d.employee_id
                                and d.payroll_date = pr.payroll_date
                        where
                            d.time_in <> '00:00:00' and d.time_out <> '00:00:00'
                        group by
                            d.payroll_date,
                            d.employee_id
                        union
                        select
                            d.employee_id as employee_id,
                            4 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            dt.title as description,
                            elr.no_of_days as no_of_day,
                            sum(elr.no_of_hours) as hrs,
                            sum(case
                                when hour(subtime(elr.date_to, '22:00:00')) < 8 then hour(subtime(elr.date_to, '22:00:00'))
                                else 0
                            end) as nd_hrs,
                            elb.balance - sum(elr.no_of_days) over (
                        order by
                            d.id) as leave_balance,
                            (case
                                -- Overtime
                                when dt.is_ot_under = 1 then 
                                    (es.basic_rate + es.allowance * 
                                    (case when e.payroll_schedule_id = 1 then 15 else count(d.time_in) end)) / 30 / 8 * 
                                    (case when dayofweek(elr.date_from) = 1 then 0.30 else dt.ot_rate end) * 
                                    abs(elr.no_of_hours - sum(case when hour(subtime(elr.date_to, '22:00:00')) < 8 then hour(subtime(elr.date_to, '22:00:00')) else 0 end)) 
                                    + 
                                    (es.basic_rate + es.allowance * 
                                    (case when e.payroll_schedule_id = 1 then 15 else count(d.time_in) end)) / (30 * 0.12) / 8 * 
                                    (case when dayofweek(elr.date_from) = 1  then 0.30 else dt.ot_rate end) * 
                                    abs(sum((case when hour(subtime(elr.date_to, '22:00:00')) < 8 then hour(subtime(elr.date_to, '22:00:00')) else 0 end)))
                                -- OT Allowance
                                when dt.is_ot_under = 3 then 
                                    sum(elr.no_of_hours) * dt.default_amnt
                                else 0
                            end) as debit,
                            case
                                when dt.is_ot_under = 2 then es.hourly_rate * elr.no_of_hours
                                else null
                            end as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        left join employee_leave_request elr on elr.employee_id = e.id
                                                                        and d.trans_date = elr.transaction_date
                        left join employee_leave_balance elb on elb.employee_id = e.id
                                                                        and elb.day_type_id = elr.day_type_id
                        left join day_type dt on
                            dt.id = elr.day_type_id
                        where
                            d.time_in <> '0000-00-00' and d.time_out <> '0000-00-00' 
                            and elr.status = 1
                            and dt.is_ot_under > 0
                        group by dt.id
                        union
                        select
                            d.employee_id as employee_id,
                            5 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            dt.title as description,
                            sum(elr.no_of_days) as no_of_day,
                            elr.no_of_hours as hrs,
                            null as nd_hrs,
                            elb.balance - sum(elr.no_of_days) as leave_balance,
                            null as debit,
                            case
                                when elb.balance - sum(elr.no_of_days) <= 0 then es.daily_rate * elr.no_of_days
                                else null
                            end as credit
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
                            d.time_in <> '0000-00-00'
                            and elr.status <> 0
                            and dt.is_ot_under = 0
                        group by
                            dt.id
                        union
                        select
                            d.employee_id as employee_id,
                            5 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            'CBA' as description,
                            null as no_of_day,
                            null as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            count(d.time_in) * 5 as debit,
                            null as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        left join piece_rate pr on pr.employee_id = d.employee_id
                                and d.payroll_date = pr.payroll_date
                        where
                            d.time_in <> '0000-00-00'
                        group by
                            d.payroll_date,
                            d.employee_id
                        union
                        select
                            d.employee_id as employee_id,
                            6 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            'Allowance' as description,
                            null as no_of_day,
                            null as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            case
                                when e.payroll_schedule_id = 1 then es.allowance * 15
                                else es.allowance * pr2.no_of_days
                            end as debit,
                            null as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        left join piece_rate pr2 on pr2.employee_id = e.id
                        where
                            d.time_in <> '00:00:00'
                        group by
                            d.payroll_date,
                            e.id
                        union
                        select
                            d.employee_id as employee_id,
                            7 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            dt2.title as description,
                            null as no_of_day,
                            null as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            es.daily_rate * dt2.rate / 8 * hour(subtime(d.time_in, d.time_out)) as debit,
                            null as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        left join employee_holiday veh on veh.date = d.trans_date
                        left join day_type dt2 on dt2.id = veh.day_type_id
                        where
                            veh.name <> ''
                        group by
                            d.employee_id
                        union
                        select
                            d.employee_id as employee_id,
                            8 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                            d.time_in <> '00:00:00'
                            and es2.title = 'REGULAR'
                        group by
                            d.employee_id,
                            d.payroll_date
                        union
                        select
                            d.employee_id as employee_id,
                            9 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            'Late' as description,
                            null as no_of_day,
                            sum(d.late_time * 60) as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            null as debit,
                            format(es.hourly_rate / 60 * sum(d.late_time * 60), 2) as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        where
                            d.time_in <> '0000-00-00'
                        group by
                            d.employee_id
                        union
                        select
                            d.employee_id as employee_id,
                            10 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
                            dep.title as department_name,
                            'Undertime' as description,
                            null as no_of_day,
                            sum(d.under_time * 60) as hrs,
                            null as nd_hrs,
                            null as leave_balance,
                            null as debit,
                            format(es.hourly_rate / 60 * sum(d.under_time * 60), 2) as credit
                        from dtr d
                        left join employees e on e.id = d.employee_id
                        left join employee_salary es on es.employees_id = d.employee_id
                        left join department dep on dep.id = e.department_id
                        where
                            d.time_in <> '0000-00-00'
                        group by
                            d.employee_id
                        union
                        select
                            d.employee_id as employee_id,
                            11 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                            d.time_in <> '0000-00-00'
                        group by
                            l.id
                        union
                        select
                            d.employee_id as employee_id,
                            12 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                            d.time_in <> '0000-00-00'
                        union
                        select
                            d.employee_id as employee_id,
                            13 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                            d.time_in <> '0000-00-00'
                        union
                        select
                            d.employee_id as employee_id,
                            14 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                            d.time_in <> '0000-00-00'
                        union
                        select
                            d.employee_id as employee_id,
                            15 as num,
                            case
                                when (dayofmonth(d.payroll_date) between 1 and 7
                                    and weekday(d.payroll_date) = 5) then 1
                                when (dayofmonth(d.payroll_date) between 8 and 14
                                    and weekday(d.payroll_date) = 5) then 2
                                when (dayofmonth(d.payroll_date) between 15 and 21
                                    and weekday(d.payroll_date) = 5) then 3
                                when (dayofmonth(d.payroll_date) between 22 and 28
                                    and weekday(d.payroll_date) = 5) then 4
                                else 0
                            end as week_count,
                            e.payroll_schedule_id as payroll_schedule_id,
                            es.every_collect_sss as every_collect_sss,
                            es.every_collect_pagibig as every_collect_pagibig,
                            es.every_collect_phic as every_collect_phic,
                            es.every_collect_tax as every_collect_tax,
                            d.payroll_date as payroll_date,
                            e.idcode as idcode,
                            e.lastname as lastname,
                            e.firstname as firstname,
                            e.middlename as middlename,
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
                        where
                        d.time_in <> '0000-00-00'");
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
