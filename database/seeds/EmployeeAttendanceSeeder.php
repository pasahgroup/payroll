<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('employee_attendance')->truncate();
        DB::table('employee_attendance')->insert(
            [
                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1003', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1003', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1003', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

                ['finger_print_id' => '1001', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1002', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],
                ['finger_print_id' => '1003', 'in_out_time' => Carbon::now()->format('Y-m-d H:i:s'), 'created_at' => $time, 'updated_at' => $time],

            ]

        );
    }
}
