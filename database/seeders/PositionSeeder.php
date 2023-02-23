<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
            DB::table('position')->insert([
                [
                    'title' => 'ACCOUNTING ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCOUNTING CLERK',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCOUNTING COST COMPTROLLER ASSISATNT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCOUNTING MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ADMIN ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ADMIN CUSTODIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ADMIN PROPERTY CUSTODIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSISTANT ACCOUNTING MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSISTANT MERCHANDISER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BUNDLING HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'COMPANY GUARD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'COMPANY NURSE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'COMPLIANCE OFFICER/SAFETY OFFICER 2',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'DISBURSEMENT SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ELECTRICIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'FINANCE MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HEAD MECHANIC',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HEAD MERCHANDISER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HR ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HR GENERALIST',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HR MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'I.T ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IMPEX ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IMPEX CLERK',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IMPEX OFFICER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IMPORT ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IT ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'IT MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'JUNIOR MERCHANDISER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'LIAISON',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'LINE LEADER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'LOGISTICS OFFICER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'LOGISTICS/LOADING COORDINATOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MACHINE MAINTENANCE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MERCHANDISING ADMINISTRATIVE ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PATTERN DIGITIZER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PATTERN MAKER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PAYROLL MASTER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PRESIDENT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PRODUCTION MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PURCHASING ASSISTANT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PURCHASING SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Q.A',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Q.A SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Q.A TEAM LEADER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'QA INSPECTOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SAMPLE MAKER HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SECURITY OFFICER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SENIOR MERCHANDISER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'VP-OPERATIONS',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'WAREHOUSE MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Q.A MANAGER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCOUNTING OFFICER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCOUNTING STAFF',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SEWING SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'RECORDER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ENCODER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BUNDLER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ELECTRIC MAINTENANCE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ENLINE QC',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'INLINE QC',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'GARBAGE SEGRATOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL PLACER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MOVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PACKER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TRIMMER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL TRIMMER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SEWER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'REVISER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SEWING MECHANIC',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'UTILITY',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL HEAT SEAL/PRESSING',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PACKING',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PACKING HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MAINTENANCE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SITE SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSIST SITE SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'COMPLIANCE HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'CUTTING HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'CUTTER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SPREADER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'CUTTING BUNDLER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'WAREHOUSE SECRETARY',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL OPERATOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCESSORIES',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSISTANT ACCESSORIES',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'FABRIC INSPECTOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'FABRIC REPLACEMENT',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HEAT SEAL HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'COMPANY DRIVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'EXECUTIVE DRIVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TRIMMING HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SAMPLE MAKER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BIAS CUTTER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HELPER ELECTRICIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SAMPLE QA',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TECHNICAL QA',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BUILDING MAINTENANCE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SEWING ACCESSORIES',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL DEPARTMENT HEAD',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'GARMENTS STOCK INVENTORY ASSIST. SUPV.',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TRUCK HELPER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'QA PACKING ACCURACY',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SAMPLE CUTTER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCESSORIES ENCODER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'Manual Head',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PRODUCTION CLERK',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'GARMENTS INVENTORY CLERK',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'OFFICE STAFF',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'GARMENTS STOCK INVENTORY HELPER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ADMIN UTILITY',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BIAS SPREADER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'WAREHOUSE CLERK',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PURCHASING LIAISON',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HEAT SEAL',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PRESSER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'CUSTODIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'PRODUCTION RECORDER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TRAINEE SEWER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSISTANT ACCESSORIES/COMPANY DRIVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HELPER ELECTRCIAN',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HELPER/ ACCESSORIES',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'GARMENTS STOCK INVENTORY SUPERVISOR',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'TRUCK DRIVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ASSISTANT MERCHANDISER ( PRINTING)',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'SEWING MOVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'REPLACER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BIAS SEWER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'HELPER/STOCK LOT WAREHOUSE',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'WASHER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'BUNDLING MOVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'CUTTING QC',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'ACCESSORIES HANDLER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'MANUAL MOVER',
                    'created_at' => Carbon::now()
                ],
                [
                    'title' => 'QA OFFICE STAFF',
                    'created_at' => Carbon::now()
                ]
            ]
        );
    }
}
